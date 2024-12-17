<?php
$servername = "localhost";
$username = "veronica.obenewaa";
$password = "22o15Be+w*ae5";
$db_name = "webtech_fall2024_veronica_obenewaa";

$conn = mysqli_connect($servername,$username,$password,$db_name);

if(!$conn) {
    error_log("Connection failed: " .mysqli_connect_error());
    die("connection failed. Please try again later.");
}
?>