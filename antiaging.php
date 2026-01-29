<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<div class="hero" style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/antiaging.png') center/cover no-repeat; color:white; padding:80px 20px; text-align:center;">
  <div>
    <h2>Anti‑Aging Treatment</h2>
    <p>Reduce fine lines and wrinkles with advanced skincare solutions</p>
  </div>
</div>

<div class="page-content" style="max-width:900px; margin:auto; padding:40px;">

    <!-- INTRO -->
    <section class="intro-section">
        <h3>About Anti‑Aging Treatment</h3>
        <p>
          Our anti‑aging treatments are designed to restore youthful radiance by targeting fine lines,
          wrinkles, and loss of elasticity. Using advanced technology and professional techniques,
          we help rejuvenate your skin for a smoother, firmer appearance.
        </p>
    </section>

    <!-- BENEFITS -->
    <section class="benefits-section" style="margin-top:40px;">
        <h3>Benefits</h3>
        <ul style="list-style:disc; margin-left:20px; color:#555;">
            <li>Smooths fine lines and wrinkles</li>
            <li>Stimulates collagen production</li>
            <li>Improves skin firmness and elasticity</li>
            <li>Revitalizes dull, tired skin</li>
        </ul>
    </section>

    <!-- TECHNOLOGY -->
    <section class="tech-section" style="margin-top:40px;">
        <h3>Technology We Use</h3>
        <p>
          Treatments may include Radio Frequency (RF), ultrasound therapy, and specialized serums
          to boost collagen and tighten skin. Each plan is personalized to your unique needs.
        </p>
    </section>

    <section class="gallery" style="margin-top:40px;">
  <h3>Before & After Results</h3>
  <div style="display:flex; gap:20px; flex-wrap:wrap;">
    <img src="images/antiaging1.avif" alt="Before Treatment" style="width:45%; border-radius:10px;">
    <img src="images/antiaging2.jpg" alt="After Treatment" style="width:45%; border-radius:10px;">
  </div>
</section>


    <!-- CALL TO ACTION -->
    <div class="cta-section" style="text-align:center; margin-top:50px;">
        <h3>Book Your Anti‑Aging Session</h3>
        <p>Turn back time and reveal youthful, radiant skin.</p>
        <a href="appointments.php" class="cta-btn" 
           style="background: #4a90e2; color:white; padding:14px 28px; border-radius:30px; text-decoration:none; font-weight:bold;">
           Book Now
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
