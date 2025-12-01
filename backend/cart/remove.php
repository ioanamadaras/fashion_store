<?php
session_start();
require_once "../config/db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../public/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Verificăm dacă avem id(id ul randului din cos) în GET 
if (isset($_GET["id"])) {
    $cart_id = $_GET["id"];
// Ștergem randul din coș doar dacă aparține utilizatorului logat
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);
}

header("Location: ../../public/cart.php");
exit;

