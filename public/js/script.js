// Set current year (guard if element missing)
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

// Newsletter fake action (guard)
const subscribeBtn = document.getElementById('subscribeBtn');
if (subscribeBtn) {
  subscribeBtn.addEventListener('click', () => {
    alert('Thanks for subscribing! 🎉 A 15% code is on its way.');
  });
}

// Add-to-cart button (toast/alert simulation)
document.querySelectorAll('.btn-cart').forEach(btn => {
  btn.addEventListener('click', () => {
    alert('Item added to cart 🛒');
  });
});





document.addEventListener("DOMContentLoaded", () => {
  let cartCount = 0;
  const cartCountEl = document.getElementById("cart-count");

  // Quantity Controls
  document.querySelectorAll(".product-card").forEach(card => {
    const qtyEl = card.querySelector(".qty");
    let qty = 1;

    card.querySelector(".btn-increase").addEventListener("click", () => {
      qty++;
      qtyEl.textContent = qty;
    });

    card.querySelector(".btn-decrease").addEventListener("click", () => {
      if (qty > 1) {
        qty--;
        qtyEl.textContent = qty;
      }
    });

    // Add to Cart
    card.querySelector(".btn-cart").addEventListener("click", () => {
      cartCount += qty;
      cartCountEl.textContent = cartCount;

      alert(`${qty} x ${card.dataset.name} added to cart!`);
    });
  });
});





/* animations */
 
 
    const reveals = document.querySelectorAll(".reveal");
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active");
        }
      });
    }, { threshold: 0.1 });

    reveals.forEach(section => observer.observe(section));





/* signup */
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("signup-modal");
  const closeBtn = document.querySelector(".close-btn");
  const form = document.getElementById("signup-form");
  if (!modal || !closeBtn || !form) return; // safety

  function showSignupModal() {
    // slight delay so main content paints after splash removal
    setTimeout(() => modal.classList.add("show"), 300);
  }

  // If splash still running, wait for custom event; else show directly
  let splashPending = document.getElementById('splash-screen') !== null;
  if (splashPending) {
    document.addEventListener('splash:done', () => {
      showSignupModal();
    }, { once: true });
  } else {
    showSignupModal();
  }

  // Close modal on clicking X
  closeBtn.addEventListener("click", () => {
    modal.classList.remove("show");
  });

  // Handle form submit
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    alert("🎉 Signup Successful! Welcome to THESARA COSMETICS.");
    modal.classList.remove("show");
  });
});

