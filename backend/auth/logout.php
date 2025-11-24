<?php
session_start();

// șterge toate datele de sesiune
session_unset();
session_destroy();

// redirect la login
header("Location: ../../public/login.php");
exit;

