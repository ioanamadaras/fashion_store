<?php
session_start();
require_once "../config/db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../public/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

if (isset($_GET["id"])) {
    $cart_id = $_GET["id"];

    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);
}

header("Location: ../../public/cart.php");
exit;

