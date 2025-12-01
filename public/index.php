<?php
session_start();
require_once "../backend/config/db_connect.php";

// Luăm toate produsele din baza de date
$stmt = $pdo->query("SELECT * FROM products ORDER BY id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Fashion Store - Acasă</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .product img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .price {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<h1>Bun venit la Fashion Store!</h1>

<?php if (isset($_SESSION["user_id"])): ?>

    <p>Ești conectată ca: <strong><?php echo $_SESSION["username"]; ?></strong></p>

    <p>
        <a href="../backend/auth/logout.php"  onclick="return confirm('Sigur vrei să te deloghezi?');">Ieșire din cont</a>
    </p>

    <p>
        <a href="cart.php">Vezi coșul</a>
    </p>


    <?php if ($_SESSION["role"] === "admin"): ?>
        <p><a href="admin/dashboard.php">Panou Admin</a></p>
    <?php endif; ?>

<?php else: ?>

    <p>Nu ești conectată!</p>
    <p>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    </p>

<?php endif; ?>

<hr>

<h2>Produsele magazinului</h2>

<div class="grid">
    <?php foreach ($products as $p): ?>
        <div class="product">
            <a href="product.php?id=<?php echo $p['id']; ?>">
                <img src="assets/images/<?php echo $p['image']; ?>" alt="Produs">
                <h3><?php echo $p['name']; ?></h3>

            </a>

            <p class="price"><?php echo $p['price']; ?> lei</p>
            <p><?php echo $p['categorie']; ?> • <?php echo $p['gender']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
