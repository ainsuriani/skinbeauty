document.addEventListener("DOMContentLoaded", function() {
  // Highlight active nav link
  const navLinks = document.querySelectorAll("nav a");
  navLinks.forEach(link => {
    link.addEventListener("click", function() {
      navLinks.forEach(l => l.classList.remove("active"));
      this.classList.add("active");
    });
  });

  // Smooth scroll for anchor links
  navLinks.forEach(link => {
    link.addEventListener("click", function(e) {
      if (this.hash !== "") {
        e.preventDefault();
        document.querySelector(this.hash).scrollIntoView({
          behavior: "smooth"
        });
      }
    });
  });

  // FAQ toggle (collapsible answers)
  const faqItems = document.querySelectorAll(".faq-container p");
  faqItems.forEach(item => {
    item.addEventListener("click", function() {
      this.classList.toggle("open");
    });
  });
});
