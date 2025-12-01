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
$areThereSizes = !empty($sizes);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - Fashion Store</title>
</head>
<body>

<div class="product-page">

    <img class="product-image"
         src="assets/images/<?php echo $product['image']; ?>"
         alt="Produs">

    <div class="product-details">

        <h2><?php echo $product['name']; ?></h2>

        <p class="product-price-big"><?php echo $product['price']; ?> lei</p>

        <p class="product-meta"><strong>Categorie:</strong> <?php echo $product['categorie']; ?></p>
        <p class="product-meta"><strong>Gen:</strong> <?php echo $product['gender']; ?></p>

        <p class="product-description">
            <strong>Descriere:</strong><br>
            <?php echo nl2br($product['descriere']); ?>
        </p>

        <?php if (!$areThereSizes): ?>
            <p class="product-meta" style="color: red;">Nu sunt disponibile mărimi pentru acest produs.</p>
        <?php else: ?>
            <h3 class="size-label">Alege mărimea:</h3>

            <form action="../backend/cart/add.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                <select name="size" required class="size-select">
                    <option value="">Selectează</option>
                    <?php foreach ($sizes as $s): ?>
                        <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="add-to-cart-btn">Adaugă în coș</button>
            </form>
        <?php endif; ?>

    </div>
</div>

<a class="back-link" href="index.php">← Înapoi la produse</a>

</body>
</html>

