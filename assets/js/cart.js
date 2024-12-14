document.querySelectorAll('.update-quantity').forEach(function(input) {
    input.addEventListener('change',function(){
        const cartItemID = this.getAttribute('data-cart-item-id');
        const newQuantity = this.value;

        window.location.href = '../functions/update_cart.php?cartItemID=' + cartItemID + '&quantity=' + newQuantity;

    });
});

document.querySelectorAll('.remove-item').forEach(function(button){
    button.addEventListener('click', function() {
        const cartItemID = this.getAttribute('data-cart-item-id');

        window.location.href ='../functions/delete_cart.php?cartItemID=' + cartItemID;
    });
});