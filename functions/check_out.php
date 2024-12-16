<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../vendor/autoload.php';  // Adjusted path to autoload.php

// Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51QVMEA03PKPwPcgqw73jrPK3hhEef81bg9Te6u72JATNdfZYBePxC2oqnb7MgIgCyi4ADuvV12L4qpp80E5hyzw000U1UhZ8Yt');

// Retrieve the cart data sent from JavaScript (via AJAX)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['cart'])) {
    $cart = $data['cart'];
    $lineItems = [];

    // Prepare the line items for Stripe Checkout session
    foreach ($cart as $item) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $item['name'],
                    'description' => $item['description'] ?? '',  // Optional description
                ],
                'unit_amount' => $item['price'] * 100,  // Stripe expects the amount in cents
            ],
            'quantity' => $item['quantity'] ?? 1,  // Default to 1 if not provided
        ];
    }

    // Create a Stripe Checkout session
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://localhost/telesalud/functions/success.php',  
            'cancel_url' => 'http://localhost/telesalud/functions/cancel_page.php',  
        ]);

        // Return the session URL to redirect the user to Stripe
        echo json_encode([
            'success' => true,
            'redirectUrl' => $session->url
        ]);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle any errors
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No cart items found!'
    ]);
}
?>
