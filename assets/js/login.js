const form = document.getElementById("login-form")
form.addEventListener("submit", function (event) {
	event.preventDefault();
	
	document.querySelectorAll(".error").forEach(error => error.textContent = "");
	
	const username = document.getElementById("username").value.trim();
	const email = document.getElementById("email").value.trim();
	const password = document.getElementById("password").value.trim();
	
	const savedPassword = localStorage.getItem("userPassword");
	
	let isValid =  true;
	
	if (username === "") {
		document.getElementById("username-error").textContent = "Username is required";
		isValid = false;
	}
	
	if (!validateEmail(email)) {
		document.getElementById("email-error").textContent = "Please enter a valid email address";
		isValid = false;
	}
	
	if (password === "") {
		document.getElementById("password-error").textContent = "Password is required";
		isValid = false;
	} else if (password.length < 8) {
		document.getElementById("password-error").textContent ="Password must be at least 8 characters long";
		isValid = false;
	}
	
	if(isValid) {
		form.submit();
		// if (password === savedPassword) {
		// 	alert("Login successful!");
		// 	//document.getElementById("login-form").submit();
		// 	event.target.submit();
		// } else {
		// 	document.getElementById("password-error").textContent= "Incorrect password. Please try again.";
		// }
	}
});

function validateEmail(email) {
	const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
	return re.test(String(email).toLowerCase());
}