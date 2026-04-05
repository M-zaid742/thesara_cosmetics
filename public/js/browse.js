// browse.js — Thesara Cosmetics Browse Page

document.addEventListener('DOMContentLoaded', function () {

    // Auto-submit form when category changes
    const categorySelect = document.querySelector('.filter-select');
    if (categorySelect) {
        categorySelect.addEventListener('change', function () {
            this.closest('form').submit();
        });
    }

    // Wishlist heart toggle (visual only — form still submits)
    document.querySelectorAll('.btn-wishlist').forEach(function (btn) {
        btn.addEventListener('click', function () {
            this.textContent = this.textContent.trim() === '♡' ? '♥' : '♡';
        });
    });

});