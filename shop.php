<?php
include 'auth.php';
include 'db.php';
include 'includes/header.php';

$uid = $_SESSION['user_id'];

/* ===== HANDLE ADD TO CART ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $pid = (int)$_POST['product_id'];

    // Fetch current stock
    $stmt = $conn->prepare("SELECT stock FROM products WHERE product_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $res = $stmt->get_result();
    $product = $res->fetch_assoc();

    if (!$product) exit("Product not found.");

    if ($product['stock'] > 0) {
        // Check if user already has product in cart
        $stmt2 = $conn->prepare("SELECT quantity FROM cart WHERE user_id=? AND product_id=?");
        $stmt2->bind_param("ii", $uid, $pid);
        $stmt2->execute();
        $res2 = $stmt2->get_result();

        if ($res2 && $res2->num_rows > 0) {
            $stmt3 = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id=? AND product_id=?");
            $stmt3->bind_param("ii", $uid, $pid);
            $stmt3->execute();
        } else {
            $stmt4 = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
            $stmt4->bind_param("ii", $uid, $pid);
            $stmt4->execute();
        }

        // Deduct stock from products table
        $stmt5 = $conn->prepare("UPDATE products SET stock = stock - 1 WHERE product_id=?");
        $stmt5->bind_param("i", $pid);
        $stmt5->execute();
    } else {
        echo "<script>alert('Sorry, this product is sold out!'); window.location='shop.php';</script>";
        exit();
    }

    header("Location: shop.php");
    exit();
}
/* ===== END ADD TO CART ===== */

/* ===== FETCH PRODUCTS FROM DATABASE ===== */
$productsResult = $conn->query("SELECT * FROM products ORDER BY product_id ASC");
?>

<!-- ===== TITLE SECTION WITH BACKGROUND IMAGE ===== -->
<section class="page-title-section">

<!-- ===== HERO / TITLE SECTION ===== -->
<section class="hero" style="background-image: url('images/banner.jpg');">
    <div class="hero-overlay">
        <h2 class="hero-title">Skin Care Essentials</h2>
        <p class="hero-subtitle">Discover our curated skincare products for radiant and healthy skin ✨</p>
    </div>
</section>

<!-- BACK TO TOP BUTTON -->
<button onclick="topFunction()" id="backToTopBtn" title="Go to top">
  ↑ Top
</button>

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


<section class="page-content">
    <div class="products-grid">
        <?php while ($p = $productsResult->fetch_assoc()): ?>
            <div class="product-card" data-aos="fade-up">
                <!-- IMAGE -->
                <div class="product-image">
                    <img src="images/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                </div>

                <!-- CATEGORY -->
                <span class="category-badge"><?= htmlspecialchars($p['category']) ?></span>

                <!-- NAME -->
                <h3><?= htmlspecialchars($p['name']) ?></h3>

                <!-- PRICE -->
                <p class="price">RM<?= number_format($p['price'], 2) ?></p>

                <!-- STOCK -->
                <?php if ($p['stock'] > 0): ?>
                    <small class="stock">Stock: <?= $p['stock'] ?></small>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
                        <button type="submit" class="add-btn">Add to Cart 🛒</button>
                    </form>
                <?php else: ?>
                    <span class="out-stock">Sold Out</span>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>

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

<style>
/* ===== RESET ===== */
/* ===== HERO / PAGE TITLE ===== */
.hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('images/banner.jpg') center/cover no-repeat;
    padding: 80px 20px;       /* vertical padding */
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 12px;      /* rounded corners for entire hero */
    max-width: 900px;         /* hero width */
    margin: 30px auto;        /* center on page with space above */
    overflow: hidden;         /* ensures overlay and image fit nicely */
    color: #fff;
}

/* HERO OVERLAY */
.hero-overlay {
    background: rgba(0,0,0,0.5);  /* dark semi-transparent overlay */
    padding: 30px 25px;
    border-radius: 12px;          /* keep overlay rounded */
    width: 90%;                    /* make overlay almost full hero width */
    max-width: 700px;              /* limit max width */
    margin: 0 auto;                /* center overlay */
    box-sizing: border-box;
}

/* HERO TEXT */
.hero-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 12px;
}

.hero-subtitle {
    font-size: 18px;
}

/* ===== PAGE CONTENT ===== */
.page-content {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px 60px;
}

/* ===== PRODUCTS GRID ===== */
.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 products per row */
    gap: 25px;
}

@media (max-width: 900px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 per row on medium screens */
    }
}

@media (max-width: 600px) {
    .products-grid {
        grid-template-columns: 1fr; /* 1 per row on small screens */
    }
}

/* ===== PRODUCT CARD ===== */
.product-card {
    background: #fff;
    border-radius: 18px;
    padding: 15px 20px;
    text-align: center;
    box-shadow: 0 12px 28px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    opacity: 0;
    transform: translateY(20px);
    min-height: 350px; /* fixed good height */
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.15);
}

/* ===== PRODUCT IMAGE ===== */
.product-image img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 14px;
    transition: transform 0.3s ease;
}

.product-image img:hover {
    transform: scale(1.05);
}

/* ===== CATEGORY BADGE ===== */
.category-badge {
    display: inline-block;
    margin: 10px 0 5px;
    background: #e3f2fd;
    color: #4a90e2;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* ===== PRODUCT NAME & PRICE ===== */
.product-card h3 {
    color: #333;
    margin: 8px 0 6px;
    font-size: 18px;
    font-weight: 600;
}

.price {
    font-weight: bold;
    margin-bottom: 6px;
    color: #4a90e2;
    font-size: 16px;
}

/* ===== STOCK ===== */
.stock {
    font-size: 12px;
    color: #28a745;
}

.out-stock {
    color: #ff4d4d;
    font-weight: bold;
    font-size: 13px;
}

/* ===== ADD TO CART BUTTON ===== */
.add-btn {
    margin-top: auto; /* push button to bottom */
    background: #4a90e2;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.add-btn:hover {
    background: #6fa3ef;
    transform: scale(1.05);
}

/* ===== FADE-UP ANIMATION ===== */
[data-aos="fade-up"] {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

[data-aos="fade-up"].aos-animate {
    opacity: 1;
    transform: translateY(0);
}

</style>

<!-- ===== AOS LIBRARY FOR ANIMATIONS ===== -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
AOS.init({
    duration: 800,
    once: true
});
</script>

<?php include 'includes/footer.php'; ?>
