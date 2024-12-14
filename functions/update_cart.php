<?php 
session_start();
include '../settings/configuration.php';

if(!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

$cartItemID = $_GET['cartItemID'];
$quantity = $_GET['quantity'];

//update quantity
$query = "UPDATE cartItems SET quantity = $quantity WHERE cartItemID = $cartItemID";
mysqli_query($conn, $query);

//redirect to cart page
header('Location: cart.php');
exit();
?>