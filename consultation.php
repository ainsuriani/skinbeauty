<?php 
include 'auth.php'; 
include 'db.php';          
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<div class="hero" style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/skinconsultation.jpg') center/cover no-repeat; color:white; padding:80px 20px; text-align:center;">
  <div>
    <h2>Skin Consultation</h2>
    <p>Professional evaluation and personalized skincare planning</p>
  </div>
</div>

<div class="page-content" style="max-width:900px; margin:auto; padding:40px;">

    <!-- INTRO -->
    <section class="intro-section">
        <h3>Why Skin Consultation Matters</h3>
        <p>
          Every skin journey begins with understanding. Our consultation sessions allow professionals
          to analyze your skin type, concerns, and lifestyle factors. From acne to aging, pigmentation
          to sensitivity, we design a plan that’s truly yours.
        </p>
    </section>

    <!-- PROCESS -->
    <section class="process-section" style="margin-top:40px;">
        <h3>What to Expect</h3>
        <ol style="margin-left:20px; color:#555;">
            <li><strong>Step 1:</strong> Digital skin analysis using advanced diagnostic tools</li>
            <li><strong>Step 2:</strong> Professional discussion of your concerns and goals</li>
            <li><strong>Step 3:</strong> Personalized treatment plan recommendation</li>
            <li><strong>Step 4:</strong> Guidance on home care routines and follow‑up sessions</li>
        </ol>
    </section>

    <!-- OUR APPROACH -->
    <section class="approach-section" style="margin-top:40px; background:#f9f9f9; padding:20px; border-radius:10px;">
        <h3>Our Approach</h3>
        <p>
          We believe every client deserves a tailored experience. Our consultations combine 
          dermatology‑grade expertise with empathy and clear communication. You’ll leave with 
          a personalized roadmap for healthier, radiant skin — and the confidence to follow it.
        </p>
    </section>

    <!-- CLIENT JOURNEY -->
    <section class="journey-section" style="margin-top:40px;">
        <h3>Your Journey With Us</h3>
        <div style="display:flex; gap:20px; flex-wrap:wrap;">
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Consult</h4>
                <p>Meet our professionals and share your skin concerns.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Analyze</h4>
                <p>We use advanced tools to understand your skin condition.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Plan</h4>
                <p>Receive a personalized treatment and home‑care strategy.</p>
            </div>
            <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                <h4>Transform</h4>
                <p>Begin your journey to healthier, radiant skin with ongoing support.</p>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <div class="cta-section" style="text-align:center; margin-top:50px;">
        <h3>Book Your Skin Consultation</h3>
        <p>Discover your skin’s needs and start your personalized journey today.</p>
        <a href="appointments.php" class="cta-btn" 
           style="background: #4a90e2; color:white; padding:14px 28px; border-radius:30px; text-decoration:none; font-weight:bold;">
           Book Now
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
