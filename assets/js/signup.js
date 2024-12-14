const form = document.getElementById("signup-form");

form.addEventListener("submit", function (event) {
	event.preventDefault();
	
	document.querySelectorAll(".error").forEach(error => error.textContent = "");
	
	const username = document.getElementById("username").value.trim();
	const email = document.getElementById("email").value.trim();
	const password = document.getElementById("password").value.trim();
	const confirmPassword = document.getElementById("confirm-password").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const address = document.getElementById("address").value.trim();
	
	//validate input
	let isValid =  true;
	
	if (username === "") {
		document.getElementById("username-error").textContent = "Username is required";
		isValid = false;
	}

	if(email===""){
		document.getElementById("email-error").textContent = "Email is required";
		isValid = false;
	}else if (!validateEmail(email)) {
		document.getElementById("email-error").textContent = "Please enter a valid email address";
		isValid = false;
	}
	

	if (password === "") {
		document.getElementById("password-error").textContent ="Password is required."
		isValid = false;
	}else if (!validatePassword(password)) {
		document.getElementById("password-error").textContent = "Password must be at least 8 characters long, contain at least one uppercase letter, include at least three digits, and have at least one special character";
		isValid = false;
	}
	
	if (confirmPassword === "") {
		document.getElementById("confirm-password-error").textContent = "Please confirm your password";
		isValid = false;
	} else if (password !== confirmPassword) {
		document.getElementById("confirm-password-error").textContent = "Passwords do not match";
		isValid = false;
	}

    if (phone === "") {
		document.getElementById("phone-error").textContent = "Phone number is required";
		isValid = false;
	}

    if (address === "") {
		document.getElementById("address-error").textContent = "Address is required";
		isValid = false;
	}
	
	//store password in localstorage 
	if(isValid) {

		console.log(username);
		//localStorage.setItem("userPassword", password);
		// alert("sign-up successful! Redirecting to login page.....");
		form.submit();
	}
	
});

function validateEmail(email) {
	const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
	return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
	const minLength = /.{8,}/;
	const uppercase = /[A-Z]/;
	const digits = /\d.*\d.*\d/;
	const specialChar = /[!@#$%^&*(),.<>:|{}]/;
	
	return minLength.test(password) &&
			uppercase.test(password) &&
			digits.test(password) &&
			specialChar.test(password);
}