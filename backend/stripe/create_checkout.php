<?php
session_start();
require_once "../config/db_connect.php";
require_once "stripe_config.php";

// Dacă userul nu e logat, redirect la login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../../public/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$_SESSION["checkout_data"] = [
    "fullname" => $_POST["fullname"],
    "email"    => $_POST["email"],
    "phone"    => $_POST["phone"],
    "country"  => $_POST["country"],
    "city"     => $_POST["city"],
    "street"   => $_POST["street"],
    "postal"   => $_POST["postal"]
];

// 1. Luăm produsele din coș
$stmt = $pdo->prepare("
    SELECT 
        c.quantity,
        c.size,
        p.name,
        p.price
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($items)) {
    die("Coșul este gol!");
}

// 2. Creăm array-ul pentru Stripe
$line_items = [];

foreach ($items as $item) {
    $line_items[] = [
        "price_data" => [
            "currency" => "ron",
            "product_data" => [
                "name" => $item["name"] . " - Mărime: " . $item["size"],
            ],
            "unit_amount" => $item["price"] * 100
        ],
        "quantity" => $item["quantity"]
    ];
}

// 3. Creăm sesiunea de checkout
//stripe pregateste pagina reala de plata unde userul va introduce datele cardului
$session = \Stripe\Checkout\Session::create([
    "payment_method_types" => ["card"],
    "line_items" => $line_items, //trimitem produsele din cos catre stripe
    "mode" => "payment",
    "success_url" => "http://localhost/fashion_store/public/succes.php",
    "cancel_url" => "http://localhost/fashion_store/public/cart.php"
]);

// Redirect la Stripe
header("Location: " . $session->url);
exit;

?>

