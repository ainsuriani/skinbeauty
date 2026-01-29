<?php
include 'auth.php';
include 'db.php';
include 'includes/header.php';

$uid = $_SESSION['user_id'];

// Fetch cart items
$cartResult = $conn->query("SELECT c.product_id, p.name, p.price, c.quantity
                            FROM cart c
                            JOIN products p ON c.product_id = p.product_id
                            WHERE c.user_id='$uid'");

if ($cartResult->num_rows == 0) {
    echo "<p style='text-align:center; margin:50px;'>Your cart is empty 🛒. <a href='shop.php'>Go shopping</a></p>";
    include 'includes/footer.php';
    exit;
}

// Handle order submission
if (isset($_POST['checkout'])) {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // Calculate total
    $total = 0;
    $cartResult->data_seek(0); // reset pointer
    while ($row = $cartResult->fetch_assoc()) {
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    }
    $cartResult->data_seek(0); // reset pointer again for next loop

    // Insert order into orders table (fix column names)
    $conn->query("INSERT INTO orders (user_id, fullname, phone, address, date, total, payment_info)
                  VALUES ('$uid','$fullname','$phone','$address',NOW(),'$total','Cash')");
    $orderId = $conn->insert_id;

    // Move cart items to order_items
    while ($row = $cartResult->fetch_assoc()) {
        $pid = $row['product_id'];
        $qty = $row['quantity'];
        $price = $row['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price)
                      VALUES ('$orderId','$pid','$qty','$price')");
    }

    // Clear the cart
    $conn->query("DELETE FROM cart WHERE user_id='$uid'");

    echo "<p style='text-align:center; color:green; font-weight:bold; margin:50px;'>
            ✅ Order placed successfully! Your order ID is #$orderId.
          </p>
          <p style='text-align:center;'><a href='shop.php'>Continue Shopping</a></p>";
    include 'includes/footer.php';
    exit;
}
?>

<h2 style="text-align:center; color:#4a90e2; margin-bottom:20px;">Order Summary</h2>

<form method="POST" class="order-summary-form">
    <table>
        <thead>
            <tr>
                <th style="text-align:left;">Product</th>
                <th style="text-align:right;">Price (RM)</th>
                <th style="text-align:center;">Quantity</th>
                <th style="text-align:right;">Subtotal (RM)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        $cartResult->data_seek(0); // reset pointer
        while ($row = $cartResult->fetch_assoc()):
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td style="text-align:right;"><?= number_format($row['price'],2) ?></td>
                <td style="text-align:center;"><?= $row['quantity'] ?></td>
                <td style="text-align:right;"><?= number_format($subtotal,2) ?></td>
            </tr>
        <?php endwhile; ?>
            <tr style="font-weight:bold; background:#f1f1f1;">
                <td colspan="3" style="text-align:right;">Total:</td>
                <td style="text-align:right;"><?= number_format($total,2) ?></td>
            </tr>
        </tbody>
    </table>

    <h3 style="margin-top:30px; color:#4a90e2;">Delivery Information</h3>
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <textarea name="address" placeholder="Delivery Address" required></textarea>

    <button type="submit" name="checkout">Place Order</button>
</form>

<style>
.order-summary-form {
    max-width: 800px;
    margin: 30px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.order-summary-form table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.order-summary-form th, .order-summary-form td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.order-summary-form th {
    background:#4a90e2;
    color:white;
}

.order-summary-form input, .order-summary-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: all 0.3s ease;
}

.order-summary-form input:focus, .order-summary-form textarea:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 8px rgba(74,144,226,0.3);
    outline: none;
}

.order-summary-form button {
    width: 100%;
    padding: 12px;
    background: #4a90e2;
    color: white;
    border: none;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.order-summary-form button:hover {
    background: #6fa3ef;
}
</style>

<?php include 'includes/footer.php'; ?>
