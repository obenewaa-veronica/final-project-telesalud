<?php
session_start();
include '../settings/configuration.php';
require_once 'C:/xampp/htdocs/telesalud/vendor/autoload.php';

//('/../vendor/autoload.php');

//secret key
\Stripe\Stripe::setApiKey('sk_test_51QVMEA03PKPwPcgqw73jrPK3hhEef81bg9Te6u72JATNdfZYBePxC2oqnb7MgIgCyi4ADuvV12L4qpp80E5hyzw000U1UhZ8Yt');

// Get the cart contents
$userID = $_SESSION['userID'];
$query = "SELECT * FROM carts WHERE userID = $userID";
$result = mysqli_query($conn, $query);
$cart = mysqli_fetch_assoc($result);
$cartID = $cart['cartID'];

$query = "SELECT * FROM cartItems WHERE cartID = $cartID";
$cartItemsResult = mysqli_query($conn, $query);

$lineItems = [];
$totalAmount = 0;

while ($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
    $medicationQuery = "SELECT * FROM medications WHERE medicationID = {$cartItem['medicationID']}";
    $medicationResult = mysqli_query($conn, $medicationQuery);
    $medication = mysqli_fetch_assoc($medicationResult);

    $lineItems[] = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $medication['name'],
            ],
            'unit_amount' => $medication['price'] * 100,
        ],
        'quantity' => $cartItem['quantity'],
    ];

    $totalAmount += $medication['price'] * $cartItem['quantity'];
}

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => $lineItems,
    'mode' => 'payment',
    'success_url' => 'http://localhost/success.php',
    'cancel_url' => 'http://localhost/cancel.php',
]);

header("Location: " . $session->url);
exit();
?>
