<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../settings/configuration.php';

// Ensure user is logged in
// Uncomment when ready for production
// if(!isset($_SESSION['userID'])) {
//     header('Location: login.php');
//     exit();
// }

$userID = $_SESSION['userID'] ?? 0;

// Fetch or create cart for the user
$query = "SELECT * FROM carts WHERE userID = $userID";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Error fetching cart: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $cart = mysqli_fetch_assoc($result);
    $cartID = $cart['cartID'];
} else {
    // Create a new cart if none exists
    $insertCartQuery = "INSERT INTO carts (userID) VALUES ($userID)";
    if (!mysqli_query($conn, $insertCartQuery)) {
        die("Error creating cart: " . mysqli_error($conn));
    }

    // Get the newly created cart's ID
    $cartID = mysqli_insert_id($conn);
}

// Fetch cart items
$query = "SELECT * FROM cartItems WHERE cartID = $cartID";
$cartItemsResult = mysqli_query($conn, $query);

if (!$cartItemsResult) {
    die("Error fetching cart items: " . mysqli_error($conn));
}

$totalPrice = 0;
$totalItems = 0;
?>