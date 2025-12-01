<?php
session_start();
require_once "../backend/config/db_connect.php";

// Verificăm dacă s-a trimis un ID
if (!isset($_GET['id'])) {
    die("Produs invalid!");
}

$id = $_GET['id'];

// Preluăm produsul
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produsul nu există!");
}

// Preluăm mărimile disponibile
$stmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
$stmt->execute([$id]);
$sizes = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - Fashion Store</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            display: flex;
            gap: 40px;
        }

        img {
            width: 400px;
            height: 500px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .details {
            max-width: 500px;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            margin: 15px 0;
        }

        select {
            padding: 8px;
            width: 150px;
            margin-top: 10px;
        }

        button[type="submit"] {
            background: black;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="assets/images/<?php echo $product['image']; ?>" alt="Produs">

    <div class="details">
        <h2><?php echo $product['name']; ?></h2>
        <p class="price"><?php echo $product['price']; ?> lei</p>

        <p><strong>Categorie:</strong> <?php echo $product['categorie']; ?></p>
        <p><strong>Gen:</strong> <?php echo $product['gender']; ?></p>

        <p><strong>Descriere:</strong><br>
            <?php echo nl2br($product['descriere']); ?>
        </p>

        <!-- SELECT MĂRIME FĂRĂ JAVASCRIPT -->
        <h3>Alege mărimea:</h3>

        <form action="../backend/cart/add.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

            <select name="size" required>
                <option value="">Selectează</option>
                <?php foreach ($sizes as $s): ?>
                    <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
                <?php endforeach; ?>
            </select>

            <br><br>
            <button type="submit">Adaugă în coș</button>
        </form>

    </div>
</div>

<br>
<a href="index.php">← Înapoi la produse</a>

</body>
</html>

