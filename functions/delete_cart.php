<?php
session_start();
include '../settings/configuration.php';

if(!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

$cartItemID = $_GET['cartItemID'];

//delete item from cart
$query = "DELETE FROM cartItems WHERE cartItemID = $cartItemID";
mysqli_query($conn, $query);

//redirect to cart page
header('Location: cart.php');
exit();

?>