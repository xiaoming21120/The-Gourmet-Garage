// PRELOADER
const preloader = document.querySelector(".preloader");
window.addEventListener(" load", function () {
  preloader.classList.add("loaded");
  this.document.body.classList.add("loaded");
});

// HOME SLIDER SECTION
const slides = document.querySelectorAll(".slide");
let counter = 0;
let sliderInterval; // To handle auto-sliding interval
let interactionTimeout; // To track inactivity after user interaction

// Function to slide images
const slideImage = function () {
  slides.forEach(function (slide) {
    slide.style.transform = `translateX(-${counter * 100}%)`;
  });
};

// Function to start auto-sliding
const startAutoSlide = function () {
  sliderInterval = setInterval(function () {
    counter++;
    if (counter >= slides.length) {
      counter = 0;
    }
    slideImage();
  }, 4000);
};

// Function to reset the auto-sliding after interaction
const resetAutoSlide = function () {
  clearInterval(sliderInterval); // Stop auto-slide immediately
  clearTimeout(interactionTimeout); // Clear any previously set timeout

  // Set timeout to resume auto-sliding after 5 seconds of no interaction
  interactionTimeout = setTimeout(function () {
    startAutoSlide(); // Restart auto-sliding
  }, 5000);
};

// Initialize the slider
slides.forEach(function (slide, index) {
  slide.style.left = `${index * 100}%`;
  slide.style.transition = "transform 2s ease";
});

// Start the auto-sliding when the page loads
startAutoSlide();

// Next Slide Button Event
document.querySelector(".next_slide").addEventListener("click", function () {
  clearInterval(sliderInterval); // Stop auto-sliding on interaction
  counter++;
  if (counter >= slides.length) {
    counter = 0;
  }
  slideImage();
  resetAutoSlide(); // Restart auto-sliding after interaction
});

// Previous Slide Button Event
document.querySelector(".prev_slide").addEventListener("click", function () {
  clearInterval(sliderInterval); // Stop auto-sliding on interaction
  counter--;
  if (counter < 0) {
    counter = slides.length - 1;
  }
  slideImage();
  resetAutoSlide(); // Restart auto-sliding after interaction
});

// View Menu Button Event
document.querySelector(".home_menu").addEventListener("click", function () {
  document.querySelector("#menu").scrollIntoView({
    behavior: "smooth",
  });
});

// Find Table Button Event
document.querySelectorAll(".find-table").forEach(function (button) {
  button.addEventListener("click", function () {
    document.querySelector("#contact").scrollIntoView({
      behavior: "smooth",
    });
  });
});

// Form Submission Validation
function validateForm() {
  const name = document.getElementById("name").value;
  const phone = document.getElementById("phone").value;
  const persons = document.getElementById("persons").value;
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;
  const message = document.getElementById("message").value;

  if (name === "") {
    alert("Name is required.");
    return false;
  }

  const phonePattern = /^[0-9]{10}$/;
  if (!phonePattern.test(phone)) {
    alert("Please enter a valid 10-digit phone number.");
    return false;
  }

  if (persons === "") {
    alert("Please select the number of persons.");
    return false;
  }

  if (date === "") {
    alert("Please select a date.");
    return false;
  }

  if (time === "") {
    alert("Please select a time.");
    return false;
  }

  if (message === "") {
    alert("Please enter a message.");
    return false;
  }

  alert("Form submitted successfully!");
  return true;
}
