// Cart functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize cart on page load
    updateCartTotals();

    // Quantity increase buttons
    const increaseButtons = document.querySelectorAll('.btn-increase');
    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const quantityInput = cartItem.querySelector('.quantity-input');
            let currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
            updateCartTotals();
        });
    });

    // Quantity decrease buttons
    const decreaseButtons = document.querySelectorAll('.btn-decrease');
    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const quantityInput = cartItem.querySelector('.quantity-input');
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                updateCartTotals();
            }
        });
    });

    // Remove item buttons
    const removeButtons = document.querySelectorAll('.btn-remove');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            
            // Add fade out animation
            cartItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            cartItem.style.opacity = '0';
            cartItem.style.transform = 'translateX(-20px)';
            
            // Remove after animation
            setTimeout(() => {
                cartItem.remove();
                updateCartTotals();
                checkEmptyCart();
            }, 300);
        });
    });

    // Update cart totals
    function updateCartTotals() {
        const cartItems = document.querySelectorAll('.cart-item');
        let subtotal = 0;

        cartItems.forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            subtotal += price * quantity;
        });

        const shipping = 5.00;
        const total = subtotal + shipping;

        // Update display
        document.getElementById('subtotal-amount').textContent = '$' + subtotal.toFixed(2);
        document.getElementById('total-amount').textContent = '$' + total.toFixed(2);
    }

    // Check if cart is empty
    function checkEmptyCart() {
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length === 0) {
            const cartContainer = document.querySelector('.col-lg-8');
            cartContainer.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3">Your cart is empty</h4>
                    <p class="text-muted">Add some products to get started!</p>
                    <a href="/" class="btn btn-dark mt-3">Continue Shopping</a>
                </div>
            `;
        }
    }

    // Subscribe form
    const subscribeForm = document.querySelector('.subscribe-form');
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value;
            
            // Show success message
            alert('Thank you for subscribing! Check your email for a 15% discount code.');
            emailInput.value = '';
        });
    }

    // Checkout button
    const checkoutButton = document.querySelector('.summary-box .btn-dark');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function() {
            const cartItems = document.querySelectorAll('.cart-item');
            if (cartItems.length === 0) {
                alert('Your cart is empty!');
            } else {
                // Redirect to checkout page or show checkout modal
                window.location.href = '/checkout';
            }
        });
    }
});