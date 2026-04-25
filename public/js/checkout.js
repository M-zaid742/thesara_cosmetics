function togglePaymentFields() {
    const cardRadio = document.getElementById('card');
    const cardDetails = document.getElementById('card-details');
    
    if (cardRadio.checked) {
        cardDetails.style.display = 'block';
        // Add animation or transition if desired
        cardDetails.classList.add('animate__animated', 'animate__fadeIn');
    } else {
        cardDetails.style.display = 'none';
    }
}

// Ensure the correct state on page load
document.addEventListener('DOMContentLoaded', function() {
    togglePaymentFields();
});
