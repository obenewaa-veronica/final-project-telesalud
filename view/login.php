<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/x-icon" href="assets/images/favicon (3).ico">
	<link rel="stylesheet" href="../assets/css/login.css">
	<link href="https://fonts.google.com/specimen/Josefin+Sans?query=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">

	<title>Login</title>

</head>

<body>

	<div class="login-container">
		<div class="login-box">
			<h1>Login</h1>
            <!--action="../actions/login_action.php" method="POST"-->
			<form id="login-form" action="../action/login_action.php" method="POST">
				<div class="input-group">
					<?php if(isset($_GET['error'])) { ?>
						<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>

					<?php } ?>
					<label for="username">Username</label>
					<input type="text" id="username" name ="username" placeholder="Type your username">
					<div class="error" id="username-error"></div>
				</div>
				
				<div class="input-group">
					<label for="email">Email</label>
					<input type="email" id="email" name ="email" placeholder="Type your email">
					<div class="error" id="email-error"></div>
				</div>
				
				<div class="input-group">
					<label for="password">Password</label>
					<input type="password" id="password" name ="password" placeholder="Type your password">
					<div class="error" id="password-error"></div>
				</div>
				
				<a href="#" class="forgot-password">Forgot password?</a>
				<button type="submit" name="submitBtn" id="submitBtn">LOGIN</button>
			</form>
			
			<p> Or click <a href="signup.php"> Here </a> to sign up.</p>
			<div class="social-icons">
				<a href="#"><img src="../assets/images/facebook.svg" alt="Facebook"></a>
				<a href="#"><img src="../assets/images/gmail.svg" alt="Gmail"></a>
				<a href="#"><img src="../assets/images/apple.svg" alt="Apple"></a>
			</div>
	
	
		</div>
	</div>
	<script src="../assets/js/login.js"></script>


</body>


</html>