<?php
session_start();
require_once "../config/db_connect.php";

$product_id = $_POST["product_id"] ?? null;
$size       = $_POST["size"] ?? null;
$user_id    = $_SESSION["user_id"] ?? null;

// Dacă nu e logat → trimitem la login
if (!$user_id) {
    header("Location: ../../public/login.php");
    exit;
}

// Verificăm că avem produs + mărime
if (!$product_id || !$size) {
    die("Produs sau mărime lipsă!");
}

// Verificăm dacă același produs cu aceeași mărime există deja în coș
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=? AND size=?");
$stmt->execute([$user_id, $product_id, $size]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    // creștem cantitatea
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id=?");
    $stmt->execute([$existing["id"]]);
} else {
    // adăugăm produsul cu mărimea aleasă
    $stmt = $pdo->prepare("
        INSERT INTO cart (user_id, product_id, size, quantity)
        VALUES (?, ?, ?, 1)
    ");
    $stmt->execute([$user_id, $product_id, $size]);
}

header("Location: ../../public/cart.php");
exit;


