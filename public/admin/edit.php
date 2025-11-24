<?php
require '../../backend/helpers/admin_check.php';
require '../../backend/config/db_connect.php';

// Verificăm dacă avem ID-ul în URL
if (!isset($_GET['id'])) {
    die("Produs invalid!");
}

$id = $_GET['id'];

// 1. Preluăm produsul din BD
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produsul nu există!");
}

// 2. Preluăm mărimile disponibile pentru produs din product_sizes
$stmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
$stmt->execute([$id]);
$current_sizes = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editare produs</title>
</head>
<body>

<h1>Editare produs</h1>

<form action="../../backend/admin/edit_product.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    Nume:<br>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

    Cod:<br>
    <input type="text" name="code" value="<?php echo $product['code']; ?>" required><br><br>

    Imagine (nume fișier):<br>
    <input type="text" name="image" value="<?php echo $product['image']; ?>"><br><br>

    Preț:<br>
    <input type="number" step="0.01" min="1" name="price" value="<?php echo $product['price']; ?>" required><br><br>

    Descriere:<br>
    <textarea name="descriere"><?php echo $product['descriere']; ?></textarea><br><br>

    Categorie:<br>
    <input type="text" name="categorie" value="<?php echo $product['categorie']; ?>" required><br><br>

    Gen:<br>
    <select name="gender">
        <option value="Femei"   <?php if($product['gender']=="Femei") echo "selected"; ?>>Femei</option>
        <option value="Barbati" <?php if($product['gender']=="Barbati") echo "selected"; ?>>Bărbați</option>
    </select>
    <br><br>

    <!-- MĂRIMI MULTIPLE -->
    <h3>Mărimi disponibile:</h3>
    <label>
        <input type="checkbox" name="sizes[]" value="XS"
                <?php if(in_array("XS", $current_sizes)) echo "checked"; ?>>
        XS
    </label><br>

    <label>
        <input type="checkbox" name="sizes[]" value="S"
                <?php if(in_array("S", $current_sizes)) echo "checked"; ?>>
        S
    </label><br>

    <label>
        <input type="checkbox" name="sizes[]" value="M"
                <?php if(in_array("M", $current_sizes)) echo "checked"; ?>>
        M
    </label><br>

    <label>
        <input type="checkbox" name="sizes[]" value="L"
                <?php if(in_array("L", $current_sizes)) echo "checked"; ?>>
        L
    </label><br>

    <label>
        <input type="checkbox" name="sizes[]" value="XL"
                <?php if(in_array("XL", $current_sizes)) echo "checked"; ?>>
        XL
    </label><br><br>

    <button type="submit">Salvează modificările</button>
</form>

<p><a href="list.php">Înapoi la listă</a></p>

</body>
</html>


