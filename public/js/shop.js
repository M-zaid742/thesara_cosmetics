document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.btn-theme');

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      alert('🛒 Product added to cart (frontend demo only)');
    });
  });
});
