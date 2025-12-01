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
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Admin - Produse</title>
</head>

<body>

<h1 class="home-title">Administrare Produse</h1>

<div class="admin-actions">
    <a class="admin-btn secondary" href="add.php">Adaugă produs</a>
    <a class="admin-btn secondary" href="dashboard.php">Înapoi la Dashboard</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
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
            // Mărimi
            $stmtSizes = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
            $stmtSizes->execute([$p['id']]);
            $sizes = $stmtSizes->fetchAll(PDO::FETCH_COLUMN);
            ?>

            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['name']; ?></td>
                <td><?php echo $p['code']; ?></td>

                <td>
                    <img src="../assets/images/<?php echo $p['image']; ?>" alt="Produs">
                </td>

                <td><?php echo $p['price']; ?> lei</td>

                <td class="small-text">
                    <?php echo nl2br(htmlspecialchars($p['descriere'])); ?>
                </td>

                <td><?php echo $p['categorie']; ?></td>
                <td><?php echo $p['gender']; ?></td>

                <td><?php echo !empty($sizes) ? implode(", ", $sizes) : "—"; ?></td>

                <td>
                    <a class="tbl-btn edit" href="edit.php?id=<?php echo $p['id']; ?>">
                        Edit
                    </a>

                    <a class="tbl-btn delete"
                       href="../../backend/admin/delete_product.php?id=<?php echo $p['id']; ?>"
                       onclick="return confirm('Sigur ștergi acest produs?');">
                        Delete
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
