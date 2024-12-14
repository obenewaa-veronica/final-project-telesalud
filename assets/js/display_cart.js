// Utility function to get cart from local storage
function getCart() {
    let cart = localStorage.getItem("cart");

    if (!cart) {
        cart = [];
        localStorage.setItem("cart", JSON.stringify(cart)); 
    } else {
        cart = JSON.parse(cart); 
    }

    return cart;
}

// Utility function to save cart to local storage
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to remove an item from the cart by medicationID
function removeFromCart(medicationID) {
    let cart = getCart();
    cart = cart.filter(item => item.medicationID !== medicationID);
    saveCart(cart);
    console.log(`Item removed from cart: ${medicationID}`);

    // Remove the item's card from the DOM
    const itemCard = document.querySelector(`[data-medication-id="${medicationID}"]`);
    if (itemCard) {
        itemCard.remove();
    }
}
    
function updateCart(medicationID, newQuantity) {
    console.log(`Updating cart item with ID: ${medicationID}`);
    const cart = getCart();
    console.log(cart);

    const item = cart.find(item => item.medicationID === medicationID);
    console.log(item);
    if (item) {
        if (newQuantity > 0) {
            item.quantity = newQuantity; // Update the quantity
        } else {
            // Remove item if quantity is 0 or less
            removeFromCart(medicationID);
        }

        saveCart(cart); // Save the updated cart
        //console.log(`Updated cart: ${JSON.stringify(cart)}`);
    } else {
        console.log("Item not found in cart.");
    }
}


// Function to display the cart items dynamically
function displayCart() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");

    // Clear the current items
    cartItemsContainer.innerHTML = '';

    // Initialize total price
    let totalPrice = 0;

    // Check if the cart is empty
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
    } else {
        // Loop through each cart item and create a card for it
        cart.forEach(item => {
            totalPrice += item.price;

            // Create the card element for each medication
            const card = document.createElement('div');
            card.classList.add('col-md-4');
            card.classList.add('cart-card');
            card.innerHTML = `
                <div class="card">
                    <img src="${item.pictureURL}" class="card-img-center" alt="${item.name}">
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">${item.description}</p>
                        <p><strong>Price: $${item.price}</strong></p>
                        <button class="btn btn-danger" onclick="removeFromCart(${item.medicationID})">Remove</button>
                        <button class="btn btn-primary" onclick="updateCart(${item.medicationID})">Update</button>
                        
                    </div>
                </div>
            `;
            cartItemsContainer.appendChild(card);
        });
    }

    // Update the total price
    totalPriceElement.textContent = totalPrice.toFixed(2);
}

// Function to clear the entire cart
function clearCart() {
    localStorage.removeItem("cart");
    displayCart(); // Re-render the cart after clearing
}

// Function to handle order now action
function orderNow() {
    const cart = getCart();
    if (cart.length === 0) {
        alert("Your cart is empty. Please add items to your cart before ordering.");
        return;
    }

    // Redirect to checkout page or handle order submission (example)
    // Here, we'll redirect the user to a checkout page (you can replace this URL)
    window.location.href = "/checkout.html"; // Replace with your checkout page URL
}

// Call the displayCart function to populate the page
displayCart();