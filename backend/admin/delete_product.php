<?php
require '../config/db_connect.php';
require '../helpers/admin_check.php';

if (!isset($_GET['id'])) {
    die("Produs invalid!");
}

$id = $_GET['id'];


$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../../public/admin/list.php");
exit;

