document.addEventListener('DOMContentLoaded', function () {
  const heroContainer = document.querySelector('.hero-container');
  const navLinks = document.querySelector('.hero-links');
  const arrowLeft = document.querySelector('.arrow-left');
  const arrowRight = document.querySelector('.arrow-right');

  function updateArrowVisibility() {
    arrowLeft.classList.toggle('hidden', navLinks.scrollLeft === 0);
    arrowRight.classList.toggle('hidden', navLinks.scrollLeft + navLinks.clientWidth >= navLinks.scrollWidth);
  }

  navLinks.addEventListener('scroll', updateArrowVisibility);
  updateArrowVisibility();

  arrowLeft.addEventListener('click', () => {
    navLinks.scrollBy({
      left: -200,
      behavior: 'smooth'
    });
  });

  arrowRight.addEventListener('click', () => {
    navLinks.scrollBy({
      left: 200,
      behavior: 'smooth'
    });
  });
});