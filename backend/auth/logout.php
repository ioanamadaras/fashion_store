<?php
session_start(); 

session_unset(); // șterge variabilele de sesiune
session_destroy(); // distruge sesiunea

// redirect la login
header("Location: ../../public/login.php");
exit;

