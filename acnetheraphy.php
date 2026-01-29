<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<div class="hero" style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/acnetheraphy.jpg') center/cover no-repeat; color:white; padding:80px 20px; text-align:center;">
  <div>
    <h2>Acne Therapy</h2>
    <p>Targeted treatments to reduce acne, inflammation, and scarring</p>
  </div>
</div>

<div class="page-content" style="max-width:900px; margin:auto; padding:40px;">

    <!-- INTRO -->
    <section class="intro-section">
        <h3>About Acne Therapy</h3>
        <p>
          Our acne therapy treatments are designed to address the root causes of breakouts —
          excess oil, clogged pores, bacteria, and inflammation. With professional care and
          advanced technology, we help restore clearer, healthier skin.
        </p>
    </section>

    <!-- BENEFITS -->
    <section class="benefits-section" style="margin-top:40px;">
        <h3>Benefits</h3>
        <ul style="list-style:disc; margin-left:20px; color:#555;">
            <li>Reduces active breakouts and inflammation</li>
            <li>Minimizes acne scars and blemishes</li>
            <li>Improves skin texture and clarity</li>
            <li>Boosts confidence with healthier skin</li>
        </ul>
    </section>

    <!-- TECHNOLOGY -->
    <section class="tech-section" style="margin-top:40px;">
        <h3>Technology We Use</h3>
        <p>
          Depending on your skin condition, treatments may include laser/IPL systems, 
          chemical peels, or specialized topical therapies. Our professionals will 
          personalize the plan to suit your needs.
        </p>
    </section>

    <!-- CALL TO ACTION -->
    <div class="cta-section" style="text-align:center; margin-top:50px;">
        <h3>Book Your Acne Therapy Session</h3>
        <p>Take the first step towards clearer, healthier skin today.</p>
        <a href="appointments.php" class="cta-btn" 
           style="background: #4a90e2; color:white; padding:14px 28px; border-radius:30px; text-decoration:none; font-weight:bold;">
           Book Now
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
