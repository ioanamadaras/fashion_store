<?php
require '../config/db_connect.php';
require '../helpers/admin_check.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {

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

        // 2. ID produs
        $product_id = $pdo->lastInsertId();

        // 3. Inserăm mărimile dacă există
        if (!empty($_POST['sizes'])) {
            $stmt2 = $pdo->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
            foreach ($_POST['sizes'] as $size) {
                $stmt2->execute([$product_id, $size]);
            }
        }

        header("Location: ../../public/admin/list.php");
        exit;

    } catch (PDOException $e) {

        // Dacă avem cod duplicat → eroare clară pentru admin
        if ($e->getCode() == 23000) {
            die("<h2 style='color:red'>⚠ Codul <b>{$_POST["code"]}</b> există deja! Folosește alt cod.</h2>
                 <a href='../../public/admin/add.php'>Înapoi</a>");
        }

        // Alte erori PDO
        die("Eroare DB: " . $e->getMessage());
    }
}
?>



