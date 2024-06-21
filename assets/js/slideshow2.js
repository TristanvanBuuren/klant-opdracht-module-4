// scripts.js
document.addEventListener("DOMContentLoaded", function () {
  const reviewContainer = document.querySelector(".review");
  const reviewName = reviewContainer.querySelector(".review-name");
  const reviewText = reviewContainer.querySelector(".review-text");
  let currentReview = 0;

  function showNextReview() {
    // Verberg huidige review
    reviewContainer.classList.remove("active");

    // Verander de inhoud van de review
    setTimeout(() => {
      reviewName.textContent = reviews[currentReview].persoon;
      reviewText.textContent = reviews[currentReview].review;
      // Toon volgende review
      reviewContainer.classList.add("active");
    }, 1000); // Zorgt voor een overgangseffect tussen reviews

    currentReview = (currentReview + 1) % reviews.length;
  }

  // Start met de eerste review zichtbaar
  reviewName.textContent = reviews[currentReview].persoon;
  reviewText.textContent = reviews[currentReview].review;
  reviewContainer.classList.add("active");

  // Wissel elke 3 seconden van review
  setInterval(showNextReview, 15000);
});
