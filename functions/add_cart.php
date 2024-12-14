<?php
session_start();
include '../settings/configuration.php';

// if (!isset($_SESSION['userID'])) {
//     echo json_encode(['success' => false, 'message' => 'User not logged in.']);
//     exit();
// }

$userID = $_SESSION['userID'];
$medicationID = intval($_GET['medicationID']); 

// Get cartID for the user
$cartQuery = "SELECT cartID FROM carts WHERE userID = ?";
$cartStmt = $conn->prepare($cartQuery);
$cartStmt->bind_param("i", $userID);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();

if ($cartResult->num_rows === 0) {
    // Create a cart for the user if none exists
    $createCartQuery = "INSERT INTO carts (userID) VALUES (?)";
    $createCartStmt = $conn->prepare($createCartQuery);
    $createCartStmt->bind_param("i", $userID);
    $createCartStmt->execute();
    $cartID = $conn->insert_id;
} else {
    $cart = $cartResult->fetch_assoc();
    $cartID = $cart['cartID'];
}

// Check if medication is already in the cart
$cartItemQuery = "SELECT cartItemID, quantity FROM cartItems WHERE cartID = ? AND medicationID = ?";
$cartItemStmt = $conn->prepare($cartItemQuery);
$cartItemStmt->bind_param("ii", $cartID, $medicationID);
$cartItemStmt->execute();
$cartItemResult = $cartItemStmt->get_result();

if ($cartItemResult->num_rows > 0) {
    // Update quantity
    $cartItem = $cartItemResult->fetch_assoc();
    $newQuantity = $cartItem['quantity'] + 1;
    $updateQuery = "UPDATE cartItems SET quantity = ? WHERE cartItemID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ii", $newQuantity, $cartItem['cartItemID']);
    $updateStmt->execute();
} else {
    // Add new item to the cart
    $insertQuery = "INSERT INTO cartItems (cartID, medicationID, quantity) VALUES (?, ?, 1)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ii", $cartID, $medicationID);
    $insertStmt->execute();
}

//echo "<script type='text/javascript'>alert('Item added to cart successfully.');</script>";
//alert "Item added to cart successfully.";

exit();
?>
