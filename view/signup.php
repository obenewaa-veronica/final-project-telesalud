<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../assets/css/signup.css">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon (3).ico">
	<link href="https://fonts.google.com/specimen/Josefin+Sans?query=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">

	<title>Sign-Up</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">

</head>

<body>

	<div class="signup-container">
		<div class="signup-box">
			<h1>Sign Up</h1>

			<?php if (isset($_GET['message'])) { echo "<p class='message'>{$_GET['message']}</p>";} ?>
            <!--action="../actions/signup_action.php" method="POST"-->

			<form id="signup-form" action="../action/signup_action.php" method="POST">
				<div class="input-group">
					<label for="username">Username</label>
					<input type="text" id="username" name = "username" placeholder="Type your Username">
					<div class="error" id="username-error"></div>
				</div>
				
				<div class="input-group">
					<label for="email">Email</label>
					<input type="email" id="email" name = "email" placeholder="Type your email">
					<div class="error" id="email-error"></div>
				</div>
				
				
				<div class="input-group">
					<label for="password">Password</label>
					<input type="password" id="password" name = "password" placeholder="Type your password">
					<div class="error" id="password-error"></div>
				</div>
				
				<div class="input-group">
					<label for="confirm-password">Confirm Password</label>
					<input type="password" id="confirm-password" name = "confirm-password" placeholder="confirm password">
					<div class="error" id="confirm-password-error"></div>
				</div>

                <div class="input-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="233-458-6789" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
					<div class="error" id="phone-error"></div>
				</div>

                <div class="input-group">
					<label for="address">Address</label>
					<input type="text" id="address" name = "address" placeholder="Address">
					<div class="error" id="address-error"></div>
				</div>
				
				<button type="submit" name="submitBtn" id="submitBtn">SIGN UP</button>
			</form>
			
			<p>Already have an account?<a href="login.php">Login</a></p>
		</div>	
	</div>
	
	<script src="../assets/js/signup.js"></script>
	
</body>	
</html>
