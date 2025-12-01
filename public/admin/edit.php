<?php
require '../../backend/helpers/admin_check.php';
require '../../backend/config/db_connect.php';

// Verificăm dacă avem ID-ul în URL
if (!isset($_GET['id'])) {
    die("Produs invalid!");
}

$id = $_GET['id'];

// 1. Preluăm produsul
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produsul nu există!");
}

// 2. Preluăm mărimile
$stmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
$stmt->execute([$id]);
$current_sizes = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Editare produs</title>
</head>
<body>

<h1 class="home-title">Editare Produs</h1>

<div class="admin-form-container">

    <form class="admin-form-card" action="../../backend/admin/edit_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <label>Nume:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

        <label>Cod produs:</label>
        <input type="text" name="code" value="<?php echo $product['code']; ?>" required>

        <label>Imagine (ex: z001.jpg):</label>
        <input type="text" name="image" value="<?php echo $product['image']; ?>">

        <label>Preț:</label>
        <input type="number" step="0.01" min="1" name="price" value="<?php echo $product['price']; ?>" required>

        <label>Descriere:</label>
        <textarea name="descriere" rows="4"><?php echo $product['descriere']; ?></textarea>

        <label>Categorie:</label>
        <input type="text" name="categorie" value="<?php echo $product['categorie']; ?>" required>

        <label>Gen:</label>
        <select name="gender">
            <option value="Femei"   <?php if($product['gender']=="Femei") echo "selected"; ?>>Femei</option>
            <option value="Barbati" <?php if($product['gender']=="Barbati") echo "selected"; ?>>Bărbați</option>
        </select>

        <label class="sizes-title">Mărimi disponibile:</label>

        <div class="sizes-box">
            <?php
            $all_sizes = ["XS","S","M","L","XL"];
            foreach ($all_sizes as $size):
            ?>
                <label>
                    <input type="checkbox" name="sizes[]" value="<?php echo $size; ?>"
                        <?php if(in_array($size, $current_sizes)) echo "checked"; ?>>
                    <?php echo $size; ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="admin-submit-btn">Salvează modificările</button>
    </form>

    <a class="back-link admin-back" href="list.php">← Înapoi la listă</a>
</div>

</body>
</html>
