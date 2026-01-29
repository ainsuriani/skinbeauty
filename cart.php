<?php
include 'auth.php'; // ensure user is logged in
include 'db.php';
include 'includes/header.php';

$uid = $_SESSION['user_id'];

/* ===== HANDLE CART ACTIONS WITH STOCK ===== */
if (isset($_POST['action'], $_POST['product_id'])) {
    $pid = (int)$_POST['product_id'];

    // Fetch current product stock
    $stmt = $conn->prepare("SELECT stock FROM products WHERE product_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $res = $stmt->get_result();
    $product = $res->fetch_assoc();

    if (!$product) exit("Product not found.");

    if ($_POST['action'] === 'add') {
        if ($product['stock'] > 0) {
            // Check if item exists in cart
            $stmt2 = $conn->prepare("SELECT quantity FROM cart WHERE user_id=? AND product_id=?");
            $stmt2->bind_param("ii", $uid, $pid);
            $stmt2->execute();
            $res2 = $stmt2->get_result();

            if ($res2 && $res2->num_rows > 0) {
                $stmt3 = $conn->prepare(
                    "UPDATE cart SET quantity = quantity + 1 WHERE user_id=? AND product_id=?"
                );
                $stmt3->bind_param("ii", $uid, $pid);
                $stmt3->execute();
            } else {
                $stmt4 = $conn->prepare(
                    "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)"
                );
                $stmt4->bind_param("ii", $uid, $pid);
                $stmt4->execute();
            }

            // Deduct stock
            $stmt5 = $conn->prepare("UPDATE products SET stock = stock - 1 WHERE product_id=?");
            $stmt5->bind_param("i", $pid);
            $stmt5->execute();
        } else {
            echo "<script>alert('Sorry, this product is sold out!'); window.location='cart.php';</script>";
            exit();
        }
    } elseif ($_POST['action'] === 'subtract') {
        // Fetch cart quantity
        $stmt2 = $conn->prepare("SELECT quantity FROM cart WHERE user_id=? AND product_id=?");
        $stmt2->bind_param("ii", $uid, $pid);
        $stmt2->execute();
        $cartItem = $stmt2->get_result()->fetch_assoc();

        if ($cartItem && $cartItem['quantity'] > 1) {
            // Subtract quantity
            $stmt3 = $conn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE user_id=? AND product_id=?");
            $stmt3->bind_param("ii", $uid, $pid);
            $stmt3->execute();

            // Restore stock
            $stmt4 = $conn->prepare("UPDATE products SET stock = stock + 1 WHERE product_id=?");
            $stmt4->bind_param("i", $pid);
            $stmt4->execute();
        }
    } elseif ($_POST['action'] === 'delete') {
        // Fetch quantity to restore stock
        $stmt2 = $conn->prepare("SELECT quantity FROM cart WHERE user_id=? AND product_id=?");
        $stmt2->bind_param("ii", $uid, $pid);
        $stmt2->execute();
        $qty = $stmt2->get_result()->fetch_assoc()['quantity'];

        // Restore stock
        $stmt3 = $conn->prepare("UPDATE products SET stock = stock + ? WHERE product_id=?");
        $stmt3->bind_param("ii", $qty, $pid);
        $stmt3->execute();

        // Delete from cart
        $stmt4 = $conn->prepare("DELETE FROM cart WHERE user_id=? AND product_id=?");
        $stmt4->bind_param("ii", $uid, $pid);
        $stmt4->execute();
    }

    header("Location: cart.php");
    exit();
}

/* ===== FETCH CART ITEMS ===== */
$cartResult = $conn->query("
    SELECT c.product_id, p.name, p.price, c.quantity, p.image, p.stock
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id='$uid'
");
?>

<div class="page-wrapper">

<?php if ($cartResult->num_rows == 0): ?>
<!-- EMPTY CART -->
<div class="empty-cart-wrapper">
    <div class="empty-cart-card">
        <img src="images/empty_cart.jpg" alt="Empty Cart">
        <h2>Your cart is feeling lonely 🛒</h2>
        <p>You haven’t added any products yet.<br>Discover treatments and skincare made just for you ✨</p>
        <a href="shop.php" class="primary-btn">Start Shopping</a>
        <div class="empty-links">
            <a href="services.php">View Treatments</a> ·
            <a href="contact.php">Need Help?</a>
        </div>
    </div>
</div>
<?php else: ?>
<!-- CART TABLE -->
<h2 class="cart-title">Your Cart 🛒</h2>

<div class="cart-container">
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align:right;">Price (RM)</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:right;">Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        while ($row = $cartResult->fetch_assoc()):
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td class="product-info">
                    <img src="images/<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <?= htmlspecialchars($row['name']) ?>
                </td>
                <td style="text-align:right;"><?= number_format($row['price'],2) ?></td>
                <td style="text-align:center;">
                    <form method="POST" class="qty-form">
                        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                        <button name="action" value="subtract" <?= $row['quantity'] <= 1 ? 'disabled' : '' ?>>−</button>
                        <?= $row['quantity'] ?>
                        <button name="action" value="add" <?= $row['stock'] <= 0 ? 'disabled' : '' ?>>+</button>
                    </form>
                </td>
                <td style="text-align:right;"><?= number_format($subtotal,2) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                        <button name="action" value="delete" class="delete-btn">Delete ❌</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total</td>
                <td style="text-align:right;"><?= number_format($total,2) ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="checkout-container">
        <a href="order_summary.php" class="checkout-btn">Proceed to Checkout</a>
    </div>
</div>
<?php endif; ?>

</div>

<style>
/* ==== GENERAL STYLES ==== */
body { min-height:100vh; display:flex; flex-direction:column; background: linear-gradient(135deg,#eef5ff,#f8fbff); font-family: 'Segoe UI', sans-serif;}
.page-wrapper { flex:1; }

.empty-cart-wrapper { 
  min-height:60vh; /* slightly smaller height */
  display:flex; 
  justify-content:center; 
  align-items:center; 
  padding:10px;
}

.empty-cart-card { 
  background:#fff; 
  padding:30px 25px; /* reduce padding */
  border-radius:20px; 
  text-align:center; 
  max-width:400px; /* smaller width */
  width:100%; 
  box-shadow:0 12px 25px rgba(0,0,0,0.08);
}

.empty-cart-card img { 
  width:120px; /* smaller image */
  margin-bottom:20px; 
  animation: float 3s ease-in-out infinite;
}

.empty-cart-card h2 { 
  font-size:22px; /* smaller font */
  margin-bottom:10px; 
  color:#333;
}

.empty-cart-card p { 
  color:#666; 
  font-size:14px; 
  line-height:1.4; 
  margin-bottom:20px;
}

.primary-btn { 
  display:inline-block; 
  padding:12px 30px; /* smaller button */
  background:linear-gradient(135deg,#4a90e2,#6fa3ef); 
  color:#fff; 
  border-radius:25px; 
  font-weight:600; 
  text-decoration:none; 
  transition:all 0.3s ease;
}

.primary-btn:hover { 
  transform:translateY(-2px); 
  box-shadow:0 8px 18px rgba(79,139,230,0.35);
}

.empty-links { 
  margin-top:15px; 
  font-size:13px;
}

.empty-links a { 
  color:#4a90e2; 
  text-decoration:none;
}

.empty-links a:hover { 
  text-decoration: underline; 
}

.cart-title { text-align:center; margin:30px 0; color:#1976d2; font-size:28px;}
.cart-container { width:95%; max-width:1100px; margin:auto;}
.cart-table { width:100%; border-collapse:collapse; background:white; border-radius:15px; overflow:hidden; box-shadow:0 10px 25px rgba(0,0,0,0.1);}
.cart-table th { background:#4a90e2; color:white; padding:14px; text-align:left;}
.cart-table td { padding:14px; border-bottom:1px solid #eee; vertical-align:middle;}
.product-info { display:flex; align-items:center; gap:12px;}
.product-info img { width:60px; border-radius:10px;}
.qty-form { display:inline-flex; align-items:center; gap:8px;}
.qty-form button { width:32px; height:32px; border:none; background:#4a90e2; color:white; border-radius:6px; cursor:pointer;}
.qty-form button:hover { background:#357bd8;}
.qty-form button:disabled { background:#ccc; cursor:not-allowed; }
.delete-btn { background:#ff5252; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;}
.total-row td { font-weight:bold; background:#f5f9ff;}
.checkout-container { text-align:right; margin:30px 0;}
.checkout-btn { padding:14px 40px; background:linear-gradient(135deg,#43a047,#66bb6a); color:white; border-radius:30px; text-decoration:none; font-weight:600;}
.checkout-btn:hover { box-shadow:0 10px 20px rgba(67,160,71,0.4); }

@keyframes float { 50% { transform: translateY(-10px); } }
</style>

<?php include 'includes/footer.php'; ?>
