<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<section class="hero" style="background-image: url('images/banner.jpg');">
    <div class="hero-overlay">
        <h2 class="hero-title">Our Service</h2>
        <p class="hero-subtitle">Professional skincare treatments tailored just for you.</p>
    </div>
</section>

<div class="page-content">

    <div class="service-box">
        <a href="acnetheraphy.php">
            <img src="images/facialtreatment.png" alt="Facial Treatment">
            <h4>Facial Treatment</h4>
        </a>
        <p>Deep cleansing, hydration, anti-aging, and acne treatments.</p>
    </div>

    <div class="service-box">
        <a href="acnetheraphy.php">
            <img src="images/acnetheraphy.jpg" alt="Acne Therapy">
            <h4>Acne Therapy</h4>
        </a>
        <p>Clearer skin with targeted treatments to reduce breakouts and restore confidence.</p>
    </div>

    <div class="service-box">
        <a href="antiaging.php">
            <img src="images/antiaging.png" alt="Anti-Aging Treatment">
            <h4>Anti-Aging Treatment</h4>
        </a>
        <p>Advanced solutions to smooth fine lines and revitalize youthful radiance.</p>
    </div>

    <div class="service-box">
        <a href="consultation.php">
            <img src="images/skinconsultation.jpg" alt="Skin Consultation">
            <h4>Skin Consultation</h4>
        </a>
        <p>Personalized analysis and treatment planning with professionals.</p>
    </div>

    <div class="service-box">
        <a href="laser.php">
            <img src="images/lasertheraphy.jpg" alt="Laser Therapy">
            <h4>Laser Therapy</h4>
        </a>
        <p>Advanced laser solutions for pigmentation and skin rejuvenation.</p>
    </div>

    <div class="service-box">
        <a href="bodycare.php">
            <img src="images/bodycare.jpeg" alt="Body Care">
            <h4>Body Care</h4>
        </a>
        <p>Nourishing treatments to smooth, firm, and rejuvenate your skin from head to toe.</p>
    </div>
</div>

<!-- CALL TO ACTION -->
<div class="cta-section">
    <h3>Book Your Treatment Today</h3>
    <p>Experience professional skincare and see the difference yourself!</p>
    <a href="appointments.php" class="cta-btn">Book Now</a>
</div>

<!-- FLOATING CHAT BUTTON -->
<div class="chat-widget">
  <div class="chat-toggle" id="chatToggle">💬</div>

  <div class="chat-options" id="chatOptions">
    <a href="https://wa.me/601114210736" target="_blank" class="chat-btn whatsapp">
      <!-- WhatsApp SVG Icon -->
      <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
        <path d="M20.52 3.48C18.44 1.4 15.92 0 13 0 5.82 0 .01 5.82.01 13c0 2.26.59 4.38 1.62 6.24L0 24l4.91-1.59C7.38 23.41 9.5 24 11.76 24c7.18 0 13-5.82 13-13 0-2.92-1.4-5.44-3.24-7.52ZM13 21c-2.09 0-4.06-.56-5.74-1.53l-.41-.24-2.91.94.97-2.84-.27-.46C3.56 15.06 3 13.09 3 11c0-5.52 4.48-10 10-10 2.66 0 5.17 1.04 7.07 2.93C21.96 7.83 23 10.34 23 13c0 5.52-4.48 10-10 10Zm5.29-7.86c-.28-.14-1.65-.82-1.9-.91-.25-.1-.43-.14-.61.14s-.7.91-.86 1.1c-.16.18-.33.2-.61.07-1.65-.82-2.73-1.46-3.84-3.28-.28-.49.28-.45.81-1.49.09-.16.04-.3-.02-.44-.07-.14-.61-1.48-.84-2.03-.22-.53-.45-.46-.61-.47-.16-.01-.34-.01-.52-.01s-.44.07-.67.32c-.22.24-.84.82-.84 2s.86 2.31.98 2.48c.12.16 1.69 2.58 4.1 3.63.57.25 1 .4 1.35.51.57.18 1.09.15 1.5.09.46-.06 1.42-.58 1.62-1.14.2-.56.2-1.03.14-1.13-.05-.1-.21-.16-.43-.3Z"/>
      </svg>
      <span class="chat-label">WhatsApp</span>
    </a>

    <a href="https://instagram.com/skinbeautyclinic" target="_blank" class="chat-btn instagram">
      <!-- Instagram SVG Icon -->
      <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2.2c3.2 0 3.584.012 4.85.07 1.17.056 1.96.24 2.41.403a4.9 4.9 0 0 1 1.77 1.03 4.902 4.902 0 0 1 1.03 1.77c.163.45.347 1.24.403 2.41.058 1.266.07 1.65.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.24 1.96-.403 2.41a4.9 4.9 0 0 1-1.03 1.77 4.902 4.902 0 0 1-1.77 1.03c-.45.163-1.24.347-2.41.403-1.266.058-1.65.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.96-.24-2.41-.403a4.9 4.9 0 0 1-1.77-1.03 4.902 4.902 0 0 1-1.03-1.77c-.163-.45-.347-1.24-.403-2.41C2.212 15.584 2.2 15.2 2.2 12s.012-3.584.07-4.85c.056-1.17.24-1.96.403-2.41a4.9 4.9 0 0 1 1.03-1.77 4.902 4.902 0 0 1 1.77-1.03c.45-.163 1.24-.347 2.41-.403C8.416 2.212 8.8 2.2 12 2.2Zm0-2.2C8.736 0 8.332.012 7.052.07 5.773.128 4.833.312 4.042.588 3.217.868 2.518 1.28 1.88 1.88.888 2.872.472 3.572.19 4.397c-.276.791-.46 1.731-.518 3.01C-.012 8.332 0 8.736 0 12s-.012 3.668.07 4.948c.058 1.279.242 2.219.518 3.01.282.825.7 1.525 1.692 2.517.638.6 1.337 1.012 2.162 1.292.791.276 1.731.46 3.01.518C8.332 23.988 8.736 24 12 24s3.668-.012 4.948-.07c1.279-.058 2.219-.242 3.01-.518.825-.28 1.525-.7 2.517-1.692.6-.638 1.012-1.337 1.292-2.162.276-.791.46-1.731.518-3.01.058-1.28.07-1.684.07-4.948s-.012-3.668-.07-4.948c-.058-1.279-.242-2.219-.518-3.01-.28-.825-.7-1.525-1.692-2.517-.638-.6-1.337-1.012-2.162-1.292-.791-.276-1.731-.46-3.01-.518C15.668.012 15.264 0 12 0Z"/>
        <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324Zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998Z"/>
        <circle cx="18.406" cy="5.594" r="1.44"/>
      </svg>
      <span class="chat-label">Instagram</span>
    </a>

    <a href="https://facebook.com/skinbeautyclinic" target="_blank" class="chat-btn facebook">
      <!-- Facebook SVG Icon -->
      <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
        <path d="M22.676 0H1.326C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.326 24h11.495V14.708h-3.125v-3.625h3.125V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.588l-.467 3.625h-3.121V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.676 0Z"/>
      </svg>
      <span class="chat-label">Facebook</span>
    </a>
  </div>
</div>

<script>
const chatToggle = document.getElementById('chatToggle');
const chatOptions = document.getElementById('chatOptions');

chatToggle.addEventListener('click', () => {
  chatOptions.style.display = chatOptions.style.display === 'flex' ? 'none' : 'flex';
});
</script>

<style>
.chat-widget {
  position: fixed;
  bottom: 25px;
  right: 25px;
  z-index: 999;
  display: flex;
  flex-direction: column-reverse; /* so options open above button */
  align-items: flex-end;
}
.chat-toggle {
  background: #25D366;
  color: white;
  font-weight: bold;
  padding: 15px;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 0 6px 20px rgba(0,0,0,0.3);
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: pulse 2s infinite;
}
.chat-options {
  display: none;
  flex-direction: column;
  margin-bottom: 10px; /* spacing above button */
  gap: 10px;
}
.chat-btn {
  display: flex;
  align-items: center;
  justify-content: flex-start; /* icon + label */
  gap: 8px;
  padding: 10px 15px;
  border-radius: 25px;
  text-decoration: none;
  font-weight: bold;
  color: white;
  transition: transform 0.2s, opacity 0.3s;
}
.chat-btn svg {
  width: 24px;
  height: 24px;
}
.chat-btn.whatsapp { background: #25D366; }
.chat-btn.instagram { background: #E1306C; }
.chat-btn.facebook { background: #1877F2; }
.chat-btn:hover { transform: scale(1.05); opacity: 0.9; }

@keyframes pulse {
  0% { transform: scale(1); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }
  50% { transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.35); }
  100% { transform: scale(1); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }
}
</style>


<!-- BACK TO TOP BUTTON -->
<button onclick="topFunction()" id="backToTopBtn" title="Go to top">↑ Top</button>

<script>
// Get the button
let mybutton = document.getElementById("backToTopBtn");

// Show button when user scrolls down 200px
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// Scroll to top when button clicked
function topFunction() {
  window.scrollTo({top: 0, behavior: 'smooth'});
}
</script>

<!-- HERO STYLE MATCHING ABOUT PAGE -->
<style>
.hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('images/banner.jpg') center/cover no-repeat;
    padding: 80px 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    max-width: 900px;
    margin: 30px auto;
    color: #fff;
    overflow: hidden;
}

.hero-overlay {
    background: rgba(0,0,0,0.5);
    padding: 30px 25px;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    margin: 0 auto;
    box-sizing: border-box;
}

.hero-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 12px;
}

.hero-subtitle {
    font-size: 18px;
}

</style>

<?php include 'includes/footer.php'; ?>
