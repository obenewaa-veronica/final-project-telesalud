// Retrieve the cart data from localStorage
const cartData = JSON.parse(localStorage.getItem('cart'));

// Check if cartData exists
if (!cartData || cartData.length === 0) {
    console.log("Your cart is empty!");
} else {
    console.log("Cart data:", cartData);
}


document.getElementById('order-now-btn').addEventListener('click', function(event) {
    event.preventDefault();  // Prevent form submission if using a form

    // Retrieve cart data from localStorage
    const cartData = JSON.parse(localStorage.getItem('cart'));

    if (!cartData || cartData.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Send the cart data to the PHP backend using AJAX (Fetch API)
    fetch('../functions/check_out.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ cart: cartData }) // Send the cart data as a JSON string
    })
    .then(response => response.json())  // Assume the response is JSON
    .then(data => {
        
        if (data.success) {
            window.location.href = data.redirectUrl;  
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error sending cart data:', error);
        alert('Something went wrong. Please try again later.');
    });
});


