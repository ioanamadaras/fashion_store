<?php
session_start();
require_once '../config/db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === "" || $password === "") {
        echo "Completați toate câmpurile!";
        exit;
    }

    // Căutăm user-ul în baza de date
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Dacă user-ul există și parola e corectă
    if ($user && password_verify($password, $user["password"])) {

        // Salvăm datele în sesiune
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // Redirecționăm în funcție de rol
        if ($user["role"] === "admin") {
            header("Location: ../../public/admin/dashboard.php");
            exit;
        } else {
            header("Location: ../../public/index.php");
            exit;
        }


    } else {
        echo "Username sau parolă greșită!";
    }
}

