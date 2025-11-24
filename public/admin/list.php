<?php
require '../../backend/helpers/admin_check.php';
require '../../backend/config/db_connect.php';
require_once "../../backend/admin/get_products.php";


// OOP
$gp = new GetProducts($pdo);
$products = $gp->getAll();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produse</title>
</head>
<body>

<h1>Lista produselor</h1>

<p><a href="add.php">Adaugă produs</a></p>
<p><a href="dashboard.php">Înapoi la Dashboard</a></p>

<table border="1" cellpadding="10" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Nume</th>
        <th>Cod</th>
        <th>Imagine</th>
        <th>Preț</th>
        <th>Descriere</th>
        <th>Categorie</th>
        <th>Gen</th>
        <th>Mărimi</th>
        <th>Acțiuni</th>
    </tr>

    <?php foreach ($products as $p): ?>

        <?php
        // Luăm mărimile pentru produs
        $stmtSizes = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
        $stmtSizes->execute([$p['id']]);
        $sizes = $stmtSizes->fetchAll(PDO::FETCH_COLUMN);
        ?>

        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['name']; ?></td>
            <td><?php echo $p['code']; ?></td>
            <td>
                <img src="../assets/images/<?php echo $p['image']; ?>"
                     alt="Produs" width="60">
            </td>
            <td><?php echo $p['price']; ?> lei</td>
            <td><?php echo $p['descriere']; ?></td>
            <td><?php echo $p['categorie']; ?></td>
            <td><?php echo $p['gender']; ?></td>

            <td>
                <?php echo !empty($sizes) ? implode(", ", $sizes) : "—"; ?>
            </td>

            <td>
                <a href="edit.php?id=<?php echo $p['id']; ?>">Edit</a> |
                <a href="../../backend/admin/delete_product.php?id=<?php echo $p['id']; ?>"
                   onclick="return confirm('Sigur ștergi?');">Delete</a>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>

