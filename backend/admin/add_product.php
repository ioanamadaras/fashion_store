<?php
require '../config/db_connect.php';
require '../helpers/admin_check.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Inserăm produsul în tabela products
    $stmt = $pdo->prepare("
        INSERT INTO products (name, code, image, price, descriere, categorie, gender)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST["name"],
        $_POST["code"],
        $_POST["image"],
        $_POST["price"],
        $_POST["descriere"],
        $_POST["categorie"],
        $_POST["gender"]
    ]);

    // 2. Luăm ID-ul produsului proaspăt adăugat
    $product_id = $pdo->lastInsertId();

    // 3. Dacă adminul a selectat mărimi → le inserăm în product_sizes
    if (!empty($_POST['sizes'])) {

        foreach ($_POST['sizes'] as $size) {
            $stmt2 = $pdo->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
            $stmt2->execute([$product_id, $size]);
        }
    }

    header("Location: ../../public/admin/list.php");
    exit;
}
?>


