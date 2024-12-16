<?php
session_start();
include '../settings/configuration.php'; 
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['userID']; 
    $cart = json_decode(file_get_contents("php://input"), true); // Get cart data from frontend

    if (empty($cart) || !is_array($cart)) {
        header("Location: ../view/virtualpharmacy.php?error=invalid_cart");
        exit;
    }

    // Calculate total amount
    $totalAmount = 0;
    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (userID, totalAmount) VALUES (?, ?)");
    $stmt->bind_param("id", $userID, $totalAmount);

    if (!$stmt->execute()) {
        header("Location: ../view/virtualpharmacy.php?error=order_failure");
        exit;
    }

    // Get the inserted order ID
    $orderID = $stmt->insert_id; 
    $stmt->close();

    // Insert into orderitems table
    $stmt = $conn->prepare("INSERT INTO orderitems (orderID, medicationID, name, description, price, pictureURL, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($cart as $item) {
        $stmt->bind_param("iissdsi", $orderID, $item['medicationID'], $item['name'], $item['description'], $item['price'], $item['pictureURL'], $item['quantity']);
        if (!$stmt->execute()) {
            header("Location: ../view/virtualpharmacy.php?error=orderitems_failure");
            exit;
        }
    }

    $stmt->close();

    // Create Stripe checkout session
    \Stripe\Stripe::setApiKey('sk_test_51QVMEA03PKPwPcgqw73jrPK3hhEef81bg9Te6u72JATNdfZYBePxC2oqnb7MgIgCyi4ADuvV12L4qpp80E5hyzw000U1UhZ8Yt');
    $checkoutSession = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Order #' . $orderID,
                ],
                'unit_amount' => $totalAmount * 100, // Convert to cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://yourdomain.com/success.php?orderID=' . $orderID,
        'cancel_url' => 'http://yourdomain.com/cancel.php',
    ]);

    // Redirect to Stripe checkout
    header("Location: " . $checkoutSession->url);
    exit;
}
?>