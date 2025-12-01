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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <meta charset="UTF-8">
    <title>Fashion Store - Acasă</title>
</head>
<body>

<h1 class="home-title">Bun venit la Fashion Store!</h1>

<?php if (isset($_SESSION["user_id"])): ?>

    <div class="user-box">
        Ești conectată ca: 
        <strong><?php echo $_SESSION["username"]; ?></strong>
    </div>

    <div class="user-links">
        <a href="../backend/auth/logout.php" onclick="return confirm('Sigur vrei să te deloghezi?');">
            Ieșire din cont
        </a>

        <a href="cart.php">Vezi coșul</a>

        <?php if ($_SESSION["role"] === "admin"): ?>
            <a href="admin/dashboard.php">Panou Admin</a>
        <?php endif; ?>
    </div>

<?php else: ?>

    <div class="guest-box">
        <p>Nu ești conectată!</p>
        <p>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>
        </p>
    </div>

<?php endif; ?>

<hr class="separator">

<h2 class="section-title">Produsele magazinului</h2>

<div class="product-grid">
    <?php foreach ($products as $p): ?>
        <div class="product-card">
            <img src="assets/images/<?php echo $p['image']; ?>" alt="Produs">
            <div class="product-info">
                <a href="product.php?id=<?php echo $p['id']; ?>">
                    <?php echo $p['name']; ?>
                </a>
                <div class="product-price">
                    <?php echo $p['price']; ?> lei
                </div>
                <div class="product-category">
                    <?php echo $p['categorie']; ?> • <?php echo $p['gender']; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


</body>
</html>
