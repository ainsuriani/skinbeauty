<?php
include 'auth.php';
include 'db.php';

// Only allow admins
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    exit('Access denied. Admins only.');
}

// ===== UPDATE STOCK FOR ALL PRODUCTS =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stocks'])) {
    foreach ($_POST['stocks'] as $product_id => $stock) {
        $stock = (int)$stock;
        $stmt = $conn->prepare("UPDATE products SET stock=? WHERE product_id=?");
        $stmt->bind_param("ii", $stock, $product_id);
        $stmt->execute();
    }
    header("Location: admin_products.php");
    exit();
}

// ===== FETCH ALL PRODUCTS =====
$result = $conn->query("SELECT * FROM products ORDER BY product_id ASC");
?>

<h2 style="text-align:center; margin-bottom: 20px;">Admin Panel - Manage Product Stock</h2>

<form method="POST" style="max-width:1000px; margin:auto;">
<table border="1" width="100%" cellpadding="8" style="border-collapse:collapse;">
    <thead>
        <tr style="background:#4a90e2;color:white;">
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($p = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $p['product_id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td>RM<?= number_format($p['price'],2) ?></td>
            <td>
                <input type="number" name="stocks[<?= $p['product_id'] ?>]" 
                       value="<?= $p['stock'] ?>" min="0" style="width:70px;">
            </td>
            <td><?= htmlspecialchars($p['image']) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div style="text-align:center; margin-top:20px;">
    <button type="submit" style="padding:10px 20px; background:#4a90e2; color:white; border:none; border-radius:6px; cursor:pointer;">
        Update Stock
    </button>
</div>
</form>

<style>
table th, table td {
    text-align:center;
    padding:8px;
}
table input[type=number] {
    padding:4px;
    border-radius:4px;
    border:1px solid #ccc;
}
table tr:hover {
    background:#f5f5f5;
}
button:hover {
    background:#6fa3ef;
}
</style>
