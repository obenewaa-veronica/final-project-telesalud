const bar = document.getElementById('bar')
const close = document.getElementById('close')
const nav = document.getElementById('navbar')

if (bar) {
  bar.addEventListener('click', () => {
    nav.classList.add('active')
  })
 
 if (close) {
   close.addEventListener('click', () => {
     nav.classList.remove('active')
   })
 }
}


// Function to handle Buy Now button click and redirect to Stripe checkout
document.querySelectorAll('.btn-primary').forEach(button => {
  button.addEventListener('click', function(event) {
      // Prevent default button behavior
      event.preventDefault();

      // Get the product details from data attributes
      const productData = {
          id: this.getAttribute('data-product-id'),
          name: this.getAttribute('data-name'),
          price: parseFloat(this.getAttribute('data-price')),
          description: this.getAttribute('data-description'),
          picture: this.getAttribute('data-picture')
      };

      // Check if product data exists
      if (!productData.name || !productData.price) {
          alert("Product details are missing!");
          return;
      }

      // Send product data to the server to initiate the Stripe session
      fetch('../functions/checkout_buy.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ product: productData })  // Send product details to backend
      })
      .then(response => response.json())  // Expecting JSON response from the server
      .then(data => {
          if (data.success) {
              // Redirect to the Stripe checkout session
              window.location.href = data.redirectUrl;  // Redirect user to Stripe checkout page
          } else {
              alert('Error: ' + data.message);  // Show error message if session creation fails
          }
      })
      .catch(error => {
          console.error('Error sending product data:', error);
          alert('Something went wrong. Please try again later.');
      });
  });
});


