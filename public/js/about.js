// public/js/about.js
document.addEventListener('DOMContentLoaded', function () {
  // Keep "View" button functionality only
  document.querySelectorAll('.more-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const name = this.dataset.name || 'Team Member';
      alert(name + "\n\nThank you for checking our team — detailed bios coming soon!");
    });
  });

  // removed any reveal/animation code that toggles classes on load
});
