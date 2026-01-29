<?php
include 'auth.php';
include 'db.php';
include 'includes/header.php';

$sentMessage = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_SESSION['user_id'];
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    if ($conn->query("INSERT INTO contact_messages (user_id, subject, message, date)
                      VALUES ('$uid','$subject','$message', CURDATE())")) {
        $sentMessage = true;
    }
}
?>

<!-- HERO -->
<section class="hero" style="background-image: url('images/banner.jpg');">
    <div class="hero-overlay">
        <h2 class="hero-title">Contact Us</h2>
        <p class="hero-subtitle">Your skin deserves the best care — we’re here to help.</p>
    </div>
</section>

<div class="page-content">

  <?php if($sentMessage): ?>
    <div class="success-msg">✅ Thank you! Your message has been sent successfully.</div>
  <?php endif; ?>

  <div class="contact-section">
    <!-- LEFT: INFO -->
    <div class="contact-card info-card">
      <div class="info-header">
        <h3>Clinic Information</h3>
      </div>
      <div class="info-content">
        <div class="info-item">
          <p><b>Address:</b> 83, Jalan Alam Budiman, Seksyen 10, Shah Alam</p>
        </div>
        <div class="info-item">
          <span class="info-icon"></span>
          <p><b>Tel:</b> +60 1114210736</p>
        </div>
        <div class="info-item">
          <span class="info-icon"></span>
          <p><b>Email:</b> info@skinbeautyclinic.com</p>
        </div>
        <div class="info-extra">
          <p><b>Open Hours:</b> Mon - Fri | 8:00 AM - 6:00 PM</p>
          <p>We provide professional skincare services tailored for you.</p>
        </div>
      </div>
    </div>

    <!-- RIGHT: FORM -->
    <div class="contact-card form-card">
      <h3>Send Us a Message</h3>
      <form method="POST">
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Your message here..." required></textarea>
        <button type="submit">Send Message</button>
      </form>
    </div>
  </div>
</div>

<!-- FLOATING CHAT BUTTON -->
<div class="chat-widget">
  <div class="chat-toggle" id="chatToggle">💬 Chat With Us</div>

  <div class="chat-options" id="chatOptions">
    <a href="https://wa.me/601114210736" target="_blank" class="chat-btn whatsapp">WhatsApp</a>
    <a href="https://instagram.com/skinbeautyclinic" target="_blank" class="chat-btn instagram">Instagram</a>
    <a href="https://facebook.com/skinbeautyclinic" target="_blank" class="chat-btn facebook">Facebook</a>
  </div>
</div>

<!-- BACK TO TOP BUTTON -->
<button onclick="topFunction()" id="backToTopBtn" title="Go to top">
  ↑ Top
</button>

<script>
// BACK TO TOP BUTTON
let mybutton = document.getElementById("backToTopBtn");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  window.scrollTo({top: 0, behavior: 'smooth'});
}

// CHAT TOGGLE WITH ANIMATION
document.addEventListener("DOMContentLoaded", function () {
  const chatToggle = document.getElementById("chatToggle");
  const chatOptions = document.getElementById("chatOptions");

  chatToggle.addEventListener("click", function () {
    chatOptions.classList.toggle("active");
  });
});
</script>

<?php include 'includes/footer.php'; ?>

<style>
/* ===== HERO ===== */
.hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('images/banner.jpg') center/cover no-repeat;
    padding: 70px 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 12px;
    max-width: 900px;
    margin: 30px auto;
    overflow: hidden;
    color: #fff;
}
.hero-overlay {
    background: rgba(0,0,0,0.5);
    padding: 50px 25px;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    margin: 0 auto;
    box-sizing: border-box;
}
.hero-title { font-size: 36px; font-weight: 700; margin-bottom: 12px; }
.hero-subtitle { font-size: 18px; }

/* ===== CONTACT SECTION ===== */
.contact-section {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  max-width: 1000px;
  margin: 50px auto;
}
.contact-card {
  flex: 1;
  min-width: 320px;
  background: linear-gradient(145deg,#ffffff,#f7f9fc);
  padding: 30px;
  border-radius: 18px;
  box-shadow: 0 12px 25px rgba(0,0,0,0.08);
  border: 2px solid transparent;
  transition: transform 0.3s, box-shadow 0.3s, border 0.3s;
}
.contact-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 18px 35px #0000001f;
  border-image: linear-gradient(45deg,#4a90e2,#6fa3ef) 1;
}
.contact-card h3 { color: #4a90e2; margin-bottom: 20px; font-size: 22px; }
.contact-card p { margin: 5px 0; font-weight: 500; font-size: 16px; }
.info-header {
  background: linear-gradient(135deg, #0000001f, #6fa3ef);
  padding: 15px;
  border-radius: 12px 12px 0 0;
  color: white;
  text-align: center;
  margin: -30px -30px 20px -30px;
  font-weight: bold;
  font-size: 20px;
}
.info-content p { margin: 8px 0; }
.contact-card input, .contact-card textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border-radius: 12px;
  border: 1px solid #ccc;
  font-size: 15px;
  transition: box-shadow 0.3s, border 0.3s;
}
.contact-card input:focus, .contact-card textarea:focus {
  border-color: #4a90e2;
  box-shadow: 0 0 12px rgba(74,144,226,0.3);
  outline: none;
}
.contact-card textarea { height: 150px; resize: none; }
.contact-card button {
  width: 100%;
  padding: 14px;
  background: linear-gradient(45deg,#4a90e2,#6fa3ef);
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  transition: transform 0.2s, opacity 0.3s;
}
.contact-card button:hover { transform: scale(1.03); opacity: 0.9; }

.success-msg {
  max-width: 600px;
  margin: 20px auto;
  padding: 15px;
  border-radius: 10px;
  background: #d4edda;
  color: #155724;
  text-align: center;
  font-weight: bold;
}

/* ===== FLOATING CHAT BUTTON ===== */
.chat-widget { position: fixed; bottom: 25px; right: 25px; z-index: 999; }
.chat-toggle {
  background: #25D366;
  color: white;
  font-weight: bold;
  padding: 15px 25px;
  border-radius: 50px;
  cursor: pointer;
  box-shadow: 0 6px 20px rgba(0,0,0,0.3);
  font-size: 16px;
  transition: transform 0.2s;
  animation: pulse 2s infinite;
}
.chat-toggle:hover { transform: scale(1.05); background: #1ebe57; }

.chat-options {
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: absolute;
  bottom: 70px;
  right: 0;
  background: #ffffff;
  padding: 15px;
  border-radius: 16px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.25);
  opacity: 0;
  transform: translateY(15px) scale(0.95);
  pointer-events: none;
  transition: all 0.35s ease;
}
.chat-options.active {
  opacity: 1;
  transform: translateY(0) scale(1);
  pointer-events: auto;
}

.chat-btn {
  padding: 12px 20px;
  border-radius: 25px;
  text-decoration: none;
  font-weight: bold;
  color: white;
  text-align: center;
  transition: transform 0.25s ease, opacity 0.25s ease;
}
.chat-btn.whatsapp { background: #25D366; }
.chat-btn.instagram { background: #E1306C; }
.chat-btn.facebook { background: #1877F2; }
.chat-btn:hover { transform: translateX(6px); opacity: 0.95; }

@keyframes pulse {
  0% { transform: scale(1); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }
  50% { transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.35); }
  100% { transform: scale(1); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }
}
</style>
