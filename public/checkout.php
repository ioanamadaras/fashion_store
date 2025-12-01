<?php
session_start();
require_once "../backend/config/db_connect.php";

// trebuie să fii logat ca să faci checkout
if (!isset($_SESSION["user_id"])) {
    die("Trebuie să fii logat! <br><a href='login.php'>Login</a>");
}

$user_id = $_SESSION["user_id"];

// citim coșul DIN BAZA DE DATE
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
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// dacă coșul e gol
if (empty($cart_items)) {
    die("Coșul este gol! <br> <a href='index.php'>Înapoi la magazin</a>");
}

// calculăm totalul
$grand_total = 0;
foreach ($cart_items as $item) {
    $grand_total += $item["price"] * $item["quantity"];
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <meta charset="UTF-8">
    <title>Checkout - Fashion Store</title>

    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        button {
            background: black;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.85;
        }

        .totals {
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="checkout-container">

    <h2 class="checkout-title">Finalizare comandă</h2>

    <div class="checkout-card">
        <h3 class="checkout-subtitle">Date personale</h3>
        
        <form action="../backend/stripe/create_checkout.php" method="POST">

            <label>Nume complet:</label>
            <input type="text" name="fullname" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Telefon:</label>
            <input type="text" name="phone" required>

            <h3 class="checkout-subtitle">Adresă livrare</h3>

            <label>Țară:</label>
            <input type="text" name="country" required>

            <label>Oraș:</label>
            <input type="text" name="city" required>

            <label>Stradă:</label>
            <input type="text" name="street" required>

            <label>Cod poștal:</label>
            <input type="text" name="postal" required>

            <div class="checkout-total">
                <strong>Total de plată: <?php echo $grand_total; ?> lei</strong>
            </div>

            <input type="hidden" name="amount" value="<?php echo $grand_total; ?>">
            <button type="submit" class="checkout-btn">Plătește cu cardul</button>
        </form>
    </div>
</div>


</body>
</html>

