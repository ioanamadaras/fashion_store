<?php
require '../config/db_connect.php';
require '../helpers/admin_check.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"];

    // 1. Actualizăm tabelul PRODUCTS
    $stmt = $pdo->prepare("
        UPDATE products 
        SET name = ?, code = ?, image = ?, price = ?, descriere = ?, categorie = ?, gender = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $_POST["name"],
        $_POST["code"],
        $_POST["image"],
        $_POST["price"],
        $_POST["descriere"],
        $_POST["categorie"],
        $_POST["gender"],
        $id
    ]);

    // 2. Ștergem mărimile vechi
    $stmt = $pdo->prepare("DELETE FROM product_sizes WHERE product_id = ?");
    $stmt->execute([$id]);

    // 3. Inserăm mărimile noi
    if (!empty($_POST['sizes'])) {
        foreach ($_POST['sizes'] as $size) {
            $stmt2 = $pdo->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
            $stmt2->execute([$id, $size]);
        }
    }

    header("Location: ../../public/admin/list.php");
    exit;
}
