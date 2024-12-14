<?php
    include"../settings/configuration.php";

    var_dump($_POST);    

    if($_SERVER["REQUEST_METHOD"] == "POST") {
           
        $username = mysqli_real_escape_string($conn,trim($_POST['username']));
        $email = mysqli_real_escape_string($conn,trim($_POST['email']));
        $password = mysqli_real_escape_string($conn,trim($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn,trim($_POST['confirm-password']));
        $phoneNumber = mysqli_real_escape_string($conn,trim($_POST['phoneNumber']));
        $address = mysqli_real_escape_string($conn,trim($_POST['address']));

        $message='';

        if(empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($phoneNumber) || empty($address)) {
            $message = "All fields are required!!";
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format!!";
        }
        
        if ($password !== $confirm_password) {
            $message = "Passwords do not match!!";
        }
        if (strlen($password) < 8) {
            $message = "Password must be at least 8 characters long.";
            echo "$message";
        }
                //checking if the email already exists in the database
            $stmt = $conn->prepare("SELECT userID FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = "Email already exist!!";
                echo "$message";
            }
            else {
                //hashing password
                $hashed_password = password_hash($password,PASSWORD_DEFAULT);

                //set default role and timestamp
                //$role = 2;

                //$adminEmails = ['admin@gmail.com', 'superadmin@gmail.com'];

                // if(in_array($email, $adminEmails)) {
                //     $role= 1;
                // }
                
                // $timestamp = date('Y-m-d H:i:s');

                //inserting inputs into database
                $stmt =$conn->prepare("INSERT INTO users (username,email,password,phoneNumber,address) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sssss",$username, $email, $hashed_password,$phoneNumber,$address);

                if($stmt->execute()) {
                    $message = "Sigu Up Successfully!";
                    echo "$message";
                    header("Location: ../view/login.php?message=" . urlencode($message));
                    exit;
                }
                else {
                    $message = "Sign Up failed. Please try again.";
                    echo "$message";
                }
            }

            $stmt->close();
        

        header("Location: signup_action.php?message=" . urlencode($message));
        exit;

     }

    $conn->close();
    ?>