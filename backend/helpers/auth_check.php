<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    // trimite userul la login dacă nu e logat
    header("Location: ../../public/login.php");
    exit;
}