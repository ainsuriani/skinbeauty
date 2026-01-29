<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include DB connection if not already included
if (!isset($conn)) {
    include_once 'db.php';
}

// Optional: enforce login for protected pages
$public_pages = ['login.php', 'create_account.php', 'logout.php', 'health_declaration.php'];
$current_page = basename($_SERVER['PHP_SELF']);

// If user is not logged in and is on a protected page, redirect to login
if (!isset($_SESSION['user_id']) && !in_array($current_page, $public_pages)) {
    header("Location: login.php");
    exit();
}

// Optional: prevent logged-in users from accessing login/register
if (isset($_SESSION['user_id']) && in_array($current_page, ['login.php', 'create_account.php'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Skin Beauty Clinic</title>
  <link rel="stylesheet" href="css/style.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>

  <!-- TOP ROW -->
  <div class="header-top">
    <h1>Skin Beauty Clinic</h1>

    <div class="header-right">

      <!-- CART ICON -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php
          $uid = $_SESSION['user_id'];
          $cartCount = 0;
          if ($conn) {
              $stmt = $conn->prepare("SELECT COALESCE(SUM(quantity),0) AS total FROM cart WHERE user_id=?");
              $stmt->bind_param("i", $uid);
              $stmt->execute();
              $cartCount = $stmt->get_result()->fetch_assoc()['total'];
          }
        ?>
        <a href="cart.php" class="cart-icon" title="Cart">
          <i class="fa-solid fa-cart-shopping"></i>
          <?php if ($cartCount > 0): ?>
            <span class="cart-badge"><?= $cartCount ?></span>
          <?php endif; ?>
        </a>
      <?php endif; ?>

      <a href="faq.php">FAQ</a>

      <!-- PROFILE & LOGOUT -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php" class="icon-btn" title="Profile">
          <i class="fa-solid fa-user"></i>
        </a>

        <a href="logout.php" class="logout-btn" title="Logout">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      <?php else: ?>
        <!-- Login/Register for guests -->
        <a href="login.php" class="icon-btn" title="Login">
          <i class="fa-solid fa-right-to-bracket"></i> Login
        </a>
        <a href="create_account.php" class="icon-btn" title="Register">
          <i class="fa-solid fa-user-plus"></i> Register
        </a>
      <?php endif; ?>

    </div>
  </div>

  <!-- MAIN NAVIGATION -->
  <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<nav>
  <a href="home.php" class="<?= $current_page == 'home.php' ? 'active' : '' ?>">Home</a>
  <a href="about.php" class="<?= $current_page == 'about.php' ? 'active' : '' ?>">About Us</a>
  <a href="services.php" class="<?= $current_page == 'services.php' ? 'active' : '' ?>">Services</a>
  <a href="appointments.php" class="<?= $current_page == 'appointments.php' ? 'active' : '' ?>">Appointment</a>
  <a href="shop.php" class="<?= $current_page == 'shop.php' ? 'active' : '' ?>">Shop</a>
  <a href="contact.php" class="<?= $current_page == 'contact.php' ? 'active' : '' ?>">Contact</a>

  <?php 
    // Show Admin link only if user is admin
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <a href="admin_products.php" class="<?= $current_page == 'admin_products.php' ? 'active' : '' ?>">Admin</a>
  <?php endif; ?>
</nav>


</header>

<div class="page-content">
