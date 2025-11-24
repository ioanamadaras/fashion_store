<?php
session_start();
require_once "../config/db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../public/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// qty este un array: [cart_id => quantity]
if (!empty($_POST["qty"])) {

    foreach ($_POST["qty"] as $cart_id => $quantity) {

        if ($quantity <= 0) {
            // ștergem linia din coș
            $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
            $stmt->execute([$cart_id, $user_id]);
        } else {
            // actualizăm cantitatea
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$quantity, $cart_id, $user_id]);
        }
    }
}

header("Location: ../../public/cart.php");
exit;

