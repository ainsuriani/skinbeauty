<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<div class="hero" style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/lasertheraphy.jpg') center/cover no-repeat; color:white; padding:80px 20px; text-align:center;">
  <div>
    <h2>Laser Therapy</h2>
    <p>Advanced technology for skin rejuvenation and precision care</p>
  </div>
</div>

<div class="page-content" style="max-width:900px; margin:auto; padding:40px;">

    <!-- INTRO -->
    <section class="intro-section">
        <h3>About Laser Therapy</h3>
        <p>
          Our laser therapy treatments harness cutting‑edge technology to safely and effectively
          target a wide range of skin concerns — from pigmentation and scars to hair removal and
          overall rejuvenation. Each session is tailored to your skin type and goals.
        </p>
    </section>

    <!-- TECHNOLOGY HIGHLIGHT -->
    <section class="tech-highlight" style="margin-top:40px; background:#f9f9f9; padding:20px; border-radius:10px;">
        <h3>Technology We Use</h3>
        <ul style="list-style:disc; margin-left:20px; color:#555;">
            <li>Medical‑grade laser systems for precision targeting</li>
            <li>IPL (Intense Pulsed Light) for pigmentation and redness</li>
            <li>Fractional laser for scar reduction and skin resurfacing</li>
            <li>Cooling technology for comfort and safety</li>
        </ul>
    </section>

    <!-- TREATMENT APPLICATIONS -->
    <section class="applications" style="margin-top:40px;">
        <h3>What Laser Therapy Can Do</h3>
        <div style="display:flex; gap:20px; flex-wrap:wrap;">
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Pigmentation</h4>
                <p>Reduce dark spots and uneven skin tone.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Acne Scars</h4>
                <p>Smooth skin texture and minimize scarring.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Hair Removal</h4>
                <p>Safe, long‑lasting reduction of unwanted hair.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Skin Rejuvenation</h4>
                <p>Boost collagen and restore youthful glow.</p>
            </div>
        </div>
    </section>

    <!-- SAFETY & EXPERTISE -->
    <section class="safety" style="margin-top:40px;">
        <h3>Safety & Expertise</h3>
        <p>
          All procedures are performed by trained professionals using certified equipment.
          Comfort and safety are our top priorities, ensuring effective results with minimal downtime.
        </p>
    </section>

    <!-- CALL TO ACTION -->
    <div class="cta-section" style="text-align:center; margin-top:50px;">
        <h3>Book Your Laser Therapy Session</h3>
        <p>Experience the power of advanced technology for radiant, healthy skin.</p>
        <a href="appointments.php" class="cta-btn" 
           style="background: #4a90e2; color:white; padding:14px 28px; border-radius:30px; text-decoration:none; font-weight:bold;">
           Book Now
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
