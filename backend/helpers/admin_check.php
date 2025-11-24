<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    die("Acces interzis! Această zonă este doar pentru admin.");
}