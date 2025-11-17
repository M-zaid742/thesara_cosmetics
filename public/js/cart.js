// cart.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart script loaded');
    
    // Initial calculation on page load
    updateCart();
    
    // Handle increase buttons
    document.querySelectorAll('.btn-increase').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Increase button clicked');
            const input = this.parentElement.querySelector('.quantity-input');
            let currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            updateCart();
        });
    });
    
    // Handle decrease buttons
    document.querySelectorAll('.btn-decrease').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Decrease button clicked');
            const input = this.parentElement.querySelector('.quantity-input');
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateCart();
            }
        });
    });
    
    // Handle remove buttons
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Remove button clicked');
            this.closest('.cart-item').remove();
            updateCart();
            
            // Check if cart is empty
            checkEmptyCart();
        });
    });
    
    // Function to update cart totals
    function updateCart() {
        console.log('Updating cart...');
        let subtotal = 0;
        
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            subtotal += price * quantity;
            console.log(`Item price: ${price}, quantity: ${quantity}`);
        });
        
        const shipping = 5.00;
        const total = subtotal + shipping;
        
        console.log(`Subtotal: ${subtotal}, Total: ${total}`);
        
        // Update the DOM
        document.getElementById('subtotal-amount').textContent = '$' + subtotal.toFixed(2);
        document.getElementById('total-amount').textContent = '$' + total.toFixed(2);
    }
    
    // Function to check if cart is empty
    function checkEmptyCart() {
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length === 0) {
            const cartContainer = document.querySelector('.col-lg-8');
            cartContainer.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #ddd;"></i>
                    <h3 class="mt-3">Your cart is empty</h3>
                    <p class="text-muted">Add some products to get started!</p>
                    <a href="#" class="btn btn-dark mt-3">Continue Shopping</a>
                </div>
            `;
        }
    }
});