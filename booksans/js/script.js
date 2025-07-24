// js/script.js

// Slideshow auto-rotate
let slideIndex = 0;
function showSlides() {
  let slides = document.querySelectorAll(".slide");
  if (slides.length === 0) {
    // If no slides, display a placeholder or just return
    console.log("No slides found for slideshow.");
    return;
  }
  slides.forEach(slide => slide.classList.remove("active"));
  slideIndex = (slideIndex + 1) % slides.length;
  slides[slideIndex].classList.add("active");
  setTimeout(showSlides, 4000);
}
// Ensure slideshow starts only if there are slides
document.addEventListener("DOMContentLoaded", () => {
  if (document.querySelectorAll(".slide").length > 0) {
    showSlides();
  }
});


// Scroll to room details section
function scrollToDetails(id) {
  const el = document.getElementById("room-details");
  const target = document.getElementById(id);
  if (target && el) {
    window.scrollTo({ top: target.offsetTop - 50, behavior: "smooth" });
  }
}

// Open booking popup with selected room type and ID
function openBooking(roomId, roomType) {
  document.getElementById("bookingRoomId").value = roomId;
  document.getElementById("roomType").value = roomType; // Display room type in the form
  document.getElementById("bookingPopup").style.display = "flex";
}

// Close booking popup
function closeBooking() {
  document.getElementById("bookingPopup").style.display = "none";
}

// Dark mode toggle
document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("darkToggle");
  if (toggle) { // Check if toggle exists on the page
    // Apply saved dark mode preference
    if (localStorage.getItem("darkMode") === "true") {
      document.body.classList.add("dark");
      toggle.checked = true;
    }

    // Add event listener for toggle change
    toggle.addEventListener("change", () => {
      document.body.classList.toggle("dark");
      localStorage.setItem("darkMode", document.body.classList.contains("dark"));
    });
  }
});
