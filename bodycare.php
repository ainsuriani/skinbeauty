<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<div class="hero" style="background:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url('images/bodycare.jpeg') center/cover no-repeat; color:white; padding:80px 20px; text-align:center;">
  <div>
    <h2>Body Care</h2>
    <p>Relax, renew, and restore your skin & body</p>
  </div>
</div>

<div class="page-content" style="max-width:900px; margin:auto; padding:40px;">

    <!-- INTRO -->
    <section class="intro-section">
        <h3>About Body Care</h3>
        <p>
          Our body care treatments go beyond skincare — they are designed to relax your mind,
          rejuvenate your body, and restore confidence. From nourishing scrubs to firming therapies,
          every session is a holistic experience.
        </p>
    </section>

    <!-- EXPERIENCE HIGHLIGHT -->
    <section class="experience-section" style="margin-top:40px; background:#f9f9f9; padding:20px; border-radius:10px;">
        <h3>The Experience</h3>
        <p>
          Step into a calming environment where soothing aromas, gentle techniques, and premium
          products come together. Our therapists ensure each treatment is both indulgent and effective.
        </p>
    </section>

    <!-- TREATMENT OPTIONS -->
    <section class="treatments" style="margin-top:40px;">
        <h3>Popular Body Care Treatments</h3>
        <div style="display:flex; gap:20px; flex-wrap:wrap;">
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Body Scrub</h4>
                <p>Gentle exfoliation to remove dead skin cells and reveal smooth, radiant skin.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Firming Therapy</h4>
                <p>Treatments that tone and tighten for a more sculpted silhouette.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Relaxation Massage</h4>
                <p>Relieve stress and improve circulation with soothing massage techniques.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Hydrating Wrap</h4>
                <p>Deep hydration to nourish and soften skin from head to toe.</p>
            </div>
        </div>
    </section>

    <!-- HOLISTIC BENEFITS -->
    <section class="benefits" style="margin-top:40px;">
        <h3>Holistic Benefits</h3>
        <ul style="list-style:disc; margin-left:20px; color:#555;">
            <li>Smoother, healthier skin</li>
            <li>Improved body tone and circulation</li>
            <li>Stress relief and relaxation</li>
            <li>Boosted confidence and wellbeing</li>
        </ul>
    </section>

    <!-- CALL TO ACTION -->
    <div class="cta-section" style="text-align:center; margin-top:50px;">
        <h3>Book Your Body Care Session</h3>
        <p>Indulge in a spa‑like experience that rejuvenates both skin and soul.</p>
        <a href="appointments.php" class="cta-btn" 
           style="background: #4a90e2; color:white; padding:14px 28px; border-radius:30px; text-decoration:none; font-weight:bold;">
           Book Now
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
