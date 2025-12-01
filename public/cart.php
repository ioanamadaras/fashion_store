<?php
session_start();
require_once "../backend/config/db_connect.php";

// Trebuie să fie logat
if (!isset($_SESSION["user_id"])) {
    die("Trebuie să fii logată pentru a vedea coșul. <br><a href='login.php'>Login</a>");
}

$user_id = $_SESSION["user_id"];

// Luăm coșul complet din DB (cu join la products)
$stmt = $pdo->prepare("
    SELECT 
        c.id AS cart_id,
        c.product_id,
        c.size,
        c.quantity,
        p.name,
        p.price,
        p.image
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$empty = empty($items);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <meta charset="UTF-8">
    <title>Coșul tău</title>

</head>
<body>

<h1 class="cart-title">Coșul tău de cumpărături</h1>

<div class="cart-container">

<a href="index.php" class="back-link">← Înapoi la magazin</a>

<?php if ($empty): ?>

    <h3 class="empty-cart">Coșul este gol!</h3>

<?php else: ?>

    <form action="../backend/cart/update.php" method="POST">
        <table class="cart-table">
            <tr>
                <th>Imagine</th>
                <th>Nume</th>
                <th>Mărime</th>
                <th>Preț</th>
                <th>Cantitate</th>
                <th>Total</th>
                <th>Șterge</th>
            </tr>
            <?php
            $grand_total = 0;
            foreach ($items as $row):
                $line_total = $row["price"] * $row["quantity"];
                $grand_total += $line_total;
            ?>
                <tr>
                    <td><img src="assets/images/<?php echo $row['image']; ?>"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['size']; ?></td>
                    <td><?php echo $row['price']; ?> lei</td>
                    <td>
                        <input type="number"
                               name="qty[<?php echo $row['cart_id']; ?>]"
                               value="<?php echo $row['quantity']; ?>"
                               min="1">
                    </td>
                    <td><?php echo $line_total; ?> lei</td>
                    <td>
                        <a class="delete-link"
                           href="../backend/cart/remove.php?id=<?php echo $row['cart_id']; ?>">X</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="cart-actions">
            <button type="submit" class="update-btn">Actualizează coșul</button>
            <a href="checkout.php"><button type="button" class="checkout-btn">Finalizează comanda</button></a>
        </div>
    </form>
    <p class="grand-total">
        Total general: <?php echo $grand_total; ?> lei
    </p>

<?php endif; ?>

</div>

</body>
</html>

