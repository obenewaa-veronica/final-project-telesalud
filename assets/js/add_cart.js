
// Utility function to get cart from local storage
function getCart() {
    let cart = localStorage.getItem("cart");

    // If there's no cart in localStorage or it's empty, initialize a new cart
    if (!cart) {
        cart = [];
        localStorage.setItem("cart", JSON.stringify(cart)); // Store the empty cart in localStorage
    } else {
        cart = JSON.parse(cart); // Parse the cart data from localStorage
    }

    return cart;
}



// Utility function to save cart to local storage
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to add an item to the cart
// function addToCart(medicationID, name, desciption, pictureURL, price) {
//     const cart = getCart();
//     cart.push({ medicationID, name, desciption, pictureURL, price });
//     saveCart(cart);
// }

// Function to add a specific item to the cart
function addToCart(medicationID, name, description, pictureURL, price) {
    console.log("adding to cart");
    const cart = getCart();

    // Check if the medication is already in the cart
    const existingItem = cart.find(item => item.medicationID === medicationID);

    if (existingItem) {
        // If you want to increase the quantity, you could do something like this:
        existingItem.quantity += 1;
    } else {
        // Add the new medication to the cart
        cart.push({ medicationID, name, description, pictureURL, price });
    }

    // Save the updated cart to local storage
    saveCart(cart);
}

// Function to update an item in the cart
function updateCart(medicationID, newQuantity) {
    const cart = getCart();

    const item = cart.find(item => item.medicationID === medicationID);
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

// Function to remove an item from the cart by medicineId
function removeFromCart(medicationID) {
    let cart = getCart();
    cart = cart.filter(item => item.medicationID !== medicationID);
    saveCart(cart);
    console.log("Item removed from cart: ", {$medicationID});
}

// Function to clear the entire cart
function clearCart() {
    localStorage.removeItem("cart");
    console.log("Cart cleared.");
}

// Function to display the cart items
function displayCart() {
    const cart = getCart();
    console.log("Cart Items:", cart);
    return cart;
}


//displayCart(); 
//clearCart();