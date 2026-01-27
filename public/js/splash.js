// js/splash.js

document.addEventListener("DOMContentLoaded", function () {
  const splash = document.getElementById("splash-screen");

  // Wait 2.5 seconds
  setTimeout(() => {
    splash.classList.add("hide");

    // Allow scrolling again
    document.body.style.overflow = "auto";
    document.documentElement.style.overflow = "auto";

    // Remove splash after fade-out
    setTimeout(() => {
      splash.style.display = "none";
    }, 600);
  }, 2500);
});
