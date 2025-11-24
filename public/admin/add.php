<?php require '../../backend/helpers/admin_check.php'; ?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin - Adaugă Produs</title>
</head>
<body>

<h1>Adaugă produs</h1>

<form action="../../backend/admin/add_product.php" method="POST">
    Nume: <input type="text" name="name" required><br><br>
    Cod: <input type="text" name="code" required><br><br>
    Imagine (numai numele, ex: z001.jpg): <input type="text" name="image"><br><br>
    Preț: <input type="number" step="0.01" min="1" name="price" required><br><br>
    Descriere: <textarea name="descriere"></textarea><br><br>
    Categorie: <input type="text" name="categorie" required><br><br>
    Gen:
    <select name="gender">
        <option value="Femei">Femei</option>
        <option value="Barbati">Bărbați</option>
    </select>
    <br><br>
    Descriere:
    <textarea name="descriere" rows="4" cols="40"></textarea>
    <br><br>
    <label>Mărimi disponibile:</label><br>
    <input type="checkbox" name="sizes[]" value="XS"> XS<br>
    <input type="checkbox" name="sizes[]" value="S"> S<br>
    <input type="checkbox" name="sizes[]" value="M"> M<br>
    <input type="checkbox" name="sizes[]" value="L"> L<br>
    <input type="checkbox" name="sizes[]" value="XL"> XL<br>
    <br><br>


    <button type="submit">Adaugă</button>
</form>

<p><a href="list.php">Înapoi la listă</a></p>

</body>
</html>

