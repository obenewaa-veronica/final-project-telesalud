<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../settings/configuration.php';
require '../vendor/autoload.php';

// Set the Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51QVMEA03PKPwPcgqw73jrPK3hhEef81bg9Te6u72JATNdfZYBePxC2oqnb7MgIgCyi4ADuvV12L4qpp80E5hyzw000U1UhZ8Yt');
header('Content-Type: application/json');

try {
    // Read incoming JSON request body
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if the product data is valid
    if (!isset($input['product'])) {
        throw new Exception('No product data provided.');
    }

    $product = $input['product'];
    $productName = $product['name'];
    $productPrice = $product['price'];

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $productName,
                    'description' => $product['description'],
                    'images' => [$product['picture']],
                ],
                'unit_amount' => $productPrice * 100, // Stripe requires amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/telesalud/functions/success.php',
        'cancel_url' => 'http://localhost/telesalud/functions/cancel_page.php',
    ]);

    // Respond with the Stripe Checkout URL
    echo json_encode([
        'success' => true,
        'redirectUrl' => $session->url,
    ]);
} catch (Exception $e) {
    // Respond with an error
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ]);
}
