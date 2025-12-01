<?php require '../../backend/helpers/admin_check.php'; ?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Admin - Adaugă Produs</title>
</head>
<body>

<h1 class="home-title">Adaugă produs nou</h1>
<div class="admin-form-container">

    <form class="admin-form-card" action="../../backend/admin/add_product.php" method="POST">
        <label>Nume:</label>
        <input type="text" name="name" required>

        <label>Cod produs:</label>
        <input type="text" name="code" required>

        <label>Imagine (ex: z001.jpg):</label>
        <input type="text" name="image">

        <label>Preț:</label>
        <input type="number" step="0.01" min="1" name="price" required>

        <label>Descriere:</label>
        <textarea name="descriere" rows="4"></textarea>

        <label>Categorie:</label>
        <input type="text" name="categorie" required>

        <label>Gen:</label>
        <select name="gender">
            <option value="Femei">Femei</option>
            <option value="Barbati">Bărbați</option>
        </select>

        <label class="sizes-title">Mărimi disponibile:</label>

        <div class="sizes-box">
            <label><input type="checkbox" name="sizes[]" value="XS"> XS</label>
            <label><input type="checkbox" name="sizes[]" value="S"> S</label>
            <label><input type="checkbox" name="sizes[]" value="M"> M</label>
            <label><input type="checkbox" name="sizes[]" value="L"> L</label>
            <label><input type="checkbox" name="sizes[]" value="XL"> XL</label>
        </div>

        <button type="submit" class="admin-submit-btn">Adaugă produs</button>
    </form>

    <a class="back-link admin-back" href="list.php">← Înapoi la lista produselor</a>
</div>
</body>
</html>
