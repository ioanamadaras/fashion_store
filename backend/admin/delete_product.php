<?php
require '../config/db_connect.php';
require '../helpers/admin_check.php';

if (!isset($_GET['id'])) {
    die("Produs invalid!");
}

$id = $_GET['id'];

// 1. Stergi mai intai marimile asociate produsului
$stmt = $pdo->prepare("DELETE FROM product_sizes WHERE product_id = ?");
$stmt->execute([$id]);

// 2. Apoi stergi produsul
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../../public/admin/list.php");
exit;

