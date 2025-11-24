<?php
session_start();
require_once '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($username === "" || $email === "" || $password === "") {
        echo "Toate câmpurile sunt obligatorii!";
        exit;
    }

    // criptăm parola
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$username, $email, $hashedPassword]);

        // redirect la login
        header("Location: ../../public/login.php");
        exit;

    } catch (PDOException $e) {
        echo "Eroare la înregistrare: " . $e->getMessage();
    }
}