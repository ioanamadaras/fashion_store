<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'root';   // pune parola ta aici dacă ai una

/*** baza de date ***/
$db = 'fashion_store';  // aceasta este baza ta nouă

try {
    // Se creează o conexiune PDO
    $pdo = new PDO("mysql:host=$hostname;dbname=$db;charset=utf8mb4", $username, $password);

    // Setează modul de raportare a erorilor
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectat la baza de date: " . $db;


} catch (PDOException $e) {
    echo "Nu se poate conecta la baza de date: " . $e->getMessage();
    exit();
}

// Conexiunea se închide automat la finalul scriptului
?>
