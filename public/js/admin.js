const body = document.querySelector("body");
const modal = document.querySelector(".modal");
const modalButton = document.querySelector(".modal-button");
const closeButton = document.querySelector(".close-button");
const scrollDown = document.querySelector(".scroll-down");
const slides = document.querySelectorAll(".slide");
const errorMessage = document.getElementById("error-message");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
let isOpened = false;
let isClosing = false; // Flag to track if the modal is closing
let currentSlide = 0;

// Function to open the modal
const openModal = () => {
  if (isClosing) return; // Prevent opening while closing
  modal.classList.add("is-open");
  body.style.overflow = "hidden";
  isOpened = true;
};

// Function to close the modal
const closeModal = () => {
  if (isClosing) return; // Prevent closing if already closing
  isClosing = true; // Set flag to true when closing
  modal.classList.remove("is-open");
  body.style.overflow = "initial";
  setTimeout(() => {
    // Ensure that the scroll position is reset after the modal closes
    window.scrollTo({ top: 0, behavior: 'auto' });
    isClosing = false; // Reset flag after closing
    isOpened = false; // Reset opened flag
  }, 300); // Delay to ensure the closing animation completes
};

// Event listener for modal button click
modalButton.addEventListener("click", openModal);

// Event listener for close button click
closeButton.addEventListener("click", closeModal);

// Event listener for Escape key press
document.onkeydown = evt => {
  evt = evt || window.event;
  if (evt.keyCode === 27) {
    closeModal();
  }
};

// Function to show the current slide
const showSlide = () => {
  slides.forEach((slide, index) => {
    slide.style.opacity = index === currentSlide ? '1' : '0';
  });
};

// Function to move to the next slide
const nextSlide = () => {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide();
};

// Initialize slide display
showSlide();

// Change slide every 5 seconds
setInterval(nextSlide, 5000);

// Optional: Event listener to open the modal when scrolling down
window.addEventListener("scroll", () => {
  if (window.scrollY > window.innerHeight / 3 && !isOpened && !isClosing) {
    openModal();
  }
});

// Function to hide the error message when focusing on an input field
const hideErrorMessage = () => {
  if (errorMessage) {
    errorMessage.style.display = 'none';
  }
};

// Add event listeners to input fields to hide the error message
if (emailInput) {
  emailInput.addEventListener('focus', hideErrorMessage);
}
if (passwordInput) {
  passwordInput.addEventListener('focus', hideErrorMessage);
}
