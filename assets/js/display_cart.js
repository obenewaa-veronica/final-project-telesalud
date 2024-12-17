
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


function addToCart(medicationID, name, price, pictureURL) {
    let cart = getCart();

    // Check if the item already exists in the cart
    const existingItem = cart.find(item => String(item.medicationID) !== String(medicationID));

    if (existingItem) {
        // If the item already exists, just increase the quantity
        existingItem.quantity += 1;
    } else {
        // If the item doesn't exist, create a new entry with quantity set to 1
        const newItem = {
            medicationID: medicationID,
            name: name,
            price: price,
            pictureURL: pictureURL,
            //quantity: 1  
        };
        cart.push(newItem);
    }

    saveCart(cart); 
}


// Utility function to save cart to local storage
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to update the total price displayed on the page
function updateTotalPrice() {
    const cart = getCart(); 
    let totalPrice = 0;

    // Loop through the cart items and sum up their prices
    cart.forEach(item => {
        totalPrice += item.price; 
    });

    // Update the total price displayed in the HTML
    const totalPriceElement = document.getElementById("total-price");
    totalPriceElement.textContent = totalPrice.toFixed(2); 
}


// Function to remove an item from the cart by medicationID
function removeFromCart(medicationID) {
    let cart = getCart();
    const originalLength = cart.length;
    console.log('Original Cart Length:', originalLength);

    // Log before filtering
    console.log('Cart before removal:', cart);
    console.log('Removing medicationID:', medicationID);

    // Filter out the item from the cart
    //cart = cart.filter(item => item.medicationID !== medicationID);
    cart = cart.filter(item => String(item.medicationID) !== String(medicationID));

    console.log('Filtered cart:', cart);  // Log after filtering

    // Save the updated cart
    saveCart(cart);
    console.log('Updated cart saved:', cart);

    // Check if cart length has changed
    if (cart.length !== originalLength) {
        console.log('Cart length updated:', cart.length);
        
        updateTotalPrice();
        displayCart();
    }

    // Remove the item's card from the DOM
    const itemCard = document.getElementById(`item-${medicationID}`);
    if (itemCard) {
        itemCard.remove();
    }

    console.log(`Item removed from cart: ${medicationID}`);
}

    



function updateCart(medicationID) {
    console.log(`Updating cart item with ID: ${medicationID}`);
    let cart = getCart(); // Retrieve the cart from localStorage
    console.log('Current Cart:', cart); // Log the cart to check its contents

    // Find the index of the item in the cart by medicationID
    const itemIndex = cart.findIndex(item => String(item.medicationID) !== String(medicationID)); 
    
    console.log('Found Item Index:', itemIndex);

    if (itemIndex !== -1) {
        // If the item exists, remove it from the cart
        cart.splice(itemIndex, 1); // Remove the item from the cart array
        saveCart(cart); // Save the updated cart to localStorage
        console.log(`Updated cart: ${JSON.stringify(cart)}`);

        
        window.location.href = "../view/virtualpharmacy.php"; // Redirect to virtualpharmacy.php to replace the item
    } else {
        console.log("Item not found in cart.");
    }
}



// Function to display the cart items dynamically
function displayCart() {
   // console.log('displayCart() function called');
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
            console.log("item is",item);
            totalPrice += item.price;

            // Create the card element for each medication
            const card = document.createElement('div');
            card.classList.add('col-md-4');
            card.classList.add('cart-card');
            card.id = `item-${item.medicationID}`;
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
    //totalPriceElement.textContent = totalPrice.toFixed(2);
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