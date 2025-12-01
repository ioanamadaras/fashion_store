<?php
session_start();
require_once "../backend/config/db_connect.php";
require_once "../backend/mail/send_order_email.php";

if (!isset($_SESSION["user_id"])) {
    die("Trebuie să fii logat!");
}

$user_id = $_SESSION["user_id"];

//  Luăm produsele din coș înainte să îl ștergem
$stmt = $pdo->prepare("
    SELECT 
        c.product_id,
        c.size,
        c.quantity,
        p.name,
        p.price
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($items)) {
    die("Coșul tău este deja gol!");
}

// Calculăm totalul comenzii
$total = 0;
foreach ($items as $item) {
    $total += $item["price"] * $item["quantity"];
}

// Inserăm comanda în tabela `orders`
$stmt = $pdo->prepare("
    INSERT INTO orders (user_id, total, status, created_at)
    VALUES (?, ?, 'Plătită', NOW())
");
$stmt->execute([$user_id, $total]);

$order_id = $pdo->lastInsertId();

$fullname = $_SESSION["checkout_data"]["fullname"];
$email    = $_SESSION["checkout_data"]["email"];

sendOrderEmail(
    $email,
    $fullname,
    $order_id,
    $total
);

// Inserăm produsele în tabela order_items
$stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, product_id, size, quantity, price)
    VALUES (?, ?, ?, ?, ?)
");

foreach ($items as $item) {
    $stmt->execute([
        $order_id,
        $item["product_id"],
        $item["size"],
        $item["quantity"],
        $item["price"]
    ]);
}

// Ștergem coșul
$pdo->prepare("DELETE FROM cart WHERE user_id=?")->execute([$user_id]);

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Comandă finalizată</title>
</head>
<body>

<h1>Mulțumim pentru comandă!</h1>
<p>Total plătit: <strong><?php echo $total; ?> lei</strong></p>
<p>ID comandă: <strong><?php echo $order_id; ?></strong></p>

<a href="index.php">Înapoi la magazin</a>

</body>
</html>

