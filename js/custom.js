(function ($) {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    function updateVisibility() {
      const isSmallScreen = window.innerWidth < 991;

      document.querySelectorAll(".text").forEach((textBlock) => {
        const readMoreBtn = textBlock.querySelector(".read-more");
        const hiddenText = textBlock.querySelector("span");

        if (hiddenText) {
          if (isSmallScreen) {
            hiddenText.style.display = "inline"; // Prikaži tekst ispod 991px
            if (readMoreBtn) readMoreBtn.style.display = "none"; // Sakrij dugme
          } else {
            hiddenText.style.display = "none"; // Sakrij tekst iznad 991px
            if (readMoreBtn) readMoreBtn.style.display = "inline-block"; // Prikaži dugme
          }
        }

        if (readMoreBtn) {
          readMoreBtn.addEventListener("click", function (event) {
            event.preventDefault(); // Sprječava defaultno ponašanje linka
            hiddenText.style.display = "inline"; // Prikazuje span
            readMoreBtn.style.display = "none"; // Sakriva dugme "Read More"
          });
        }
      });
    }

    updateVisibility(); // Pokreni funkciju kod učitavanja stranice
    window.addEventListener("resize", updateVisibility); // Pokreni funkciju kod promjene veličine prozora
  });
})(jQuery);
