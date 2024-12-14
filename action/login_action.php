<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include "../settings/configuration.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    //validation of username or email
    if (empty($username) || empty($email)) {
        header("Location: login.php?error=Password is required.");
        exit();
    }

    //fetching the user details from the sql query
    $stmt = $conn->prepare("SELECT userID, username, email, password FROM users WHERE  email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();



    //check if user exist
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();


        //verify password
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['userID'] = $user['user_id'];
            //$_SESSION['role'] = $user['role'];

            $_SESSION['username'] = $user['username'];

            // var_dump($_SESSION['username']);
            // exit();
            header("Location: ../view/virtualpharmacy.php?message=");
            exit();
            

            // header("Location: ./recipe_feed_page.php");
            // exit;
        } else {
            header("Location: login.php?error=Incorrect password. Please try again.");
            exit();
        }
    } else {
        header("Location: signup.php?error=No account found with that username or email");
        exit();
    }
}
