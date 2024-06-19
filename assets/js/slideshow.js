document.addEventListener("DOMContentLoaded", function () {
  var slides = document.querySelectorAll(".slideshow img");
  var currentSlide = 0;
  var slideInterval = setInterval(nextSlide, 4000); // Switch slide every 4 seconds

  function nextSlide() {
    slides[currentSlide].classList.remove("active");
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add("active");
  }
});
