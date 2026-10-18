document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', () => {
      const button = form.querySelector('button[type="submit"]:not(.text-link)');
      if (button && !form.classList.contains('search')) {
        button.dataset.originalText = button.innerHTML;
        button.style.opacity = '.8';
      }
    });
  });
});
