<?php
include 'auth.php';
include 'db.php';
include 'includes/header.php';

$uid = (int)$_SESSION['user_id'];
$successMsg = $errorMsg = "";

// ================= PROFILE IMAGE UPLOAD =================
if (isset($_POST['upload_image']) && isset($_FILES['profile_image'])) {
    $file = $_FILES['profile_image'];
    $allowedTypes = ['image/jpeg','image/png','image/gif'];
    if (in_array($file['type'],$allowedTypes) && $file['size'] <= 2*1024*1024) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = "profile_$uid.".$ext;
        $uploadDir = "uploads/profiles/";
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $targetFile = $uploadDir.$newName;
        if(move_uploaded_file($file['tmp_name'], $targetFile)) {
            $update = $conn->query("UPDATE users SET profile_image='$newName' WHERE user_id='$uid'");
            $successMsg = $update ? "Profile image updated successfully!" : "Database update failed: ".$conn->error;
        } else {
            $errorMsg = "Failed to upload image.";
        }
    } else {
        $errorMsg = "Invalid file type or file too large (max 2MB).";
    }
}

// ================= FETCH USER DATA =================
$userQuery = $conn->query("SELECT * FROM users WHERE user_id='$uid'");
$user = $userQuery->fetch_assoc();
$profileImage = !empty($user['profile_image']) ? "uploads/profiles/".$user['profile_image'] : "images/default-avatar.png";

// ================= FETCH ALL HISTORY =================
$allHistoryQuery = $conn->query("
    SELECT 'Appointment' AS type, date, 'Scheduled' AS status,
       CONCAT('Service: ', service, ' at ', time) AS details,
       NULL AS user_id, NULL AS q3
FROM appointments WHERE user_id='$uid'
UNION
SELECT 'Order' AS type, date, 'Purchased' AS status,
       CONCAT('Order #', order_id, ' - RM', total) AS details,
       NULL AS user_id, NULL AS q3
FROM orders WHERE user_id='$uid'
UNION
SELECT 'Health Form' AS type, NULL AS date, 'Submitted' AS status,
       '' AS details, user_id, q3
FROM health_declaration WHERE user_id='$uid'
ORDER BY date DESC

");

$allHistory = $allHistoryQuery ? $allHistoryQuery->fetch_all(MYSQLI_ASSOC) : [];
?>

<div class="profile-dashboard">
    <!-- ================= PROFILE SIDEBAR ================= -->
    <div class="profile-sidebar">
        <div class="profile-card">
           <div class="profile-image">
    <img src="<?= htmlspecialchars($profileImage) ?>" alt="Profile Image" id="profilePreview">
</div>

<?php if(empty($user['profile_image'])): ?>
    <form method="POST" enctype="multipart/form-data" class="upload-form">
        <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)">
        <button type="submit" name="upload_image">Upload</button>
    </form>
<?php else: ?>
    <form method="POST" enctype="multipart/form-data" class="upload-form">
        <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)" style="display:none;" id="editFile">
        <button type="button" onclick="document.getElementById('editFile').click();">Edit Picture</button>
        <button type="submit" name="upload_image" style="display:none;" id="saveBtn">Save</button>
    </form>
<?php endif; ?>

            <div class="profile-info">
                <h3><?= !empty($user['full_name']) ? htmlspecialchars($user['full_name']) : 'N/A' ?></h3>
                <p><strong>Email:</strong> <?= !empty($user['email']) ? htmlspecialchars($user['email']) : 'N/A' ?></p>
                <p><strong>Phone:</strong> <?= !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'N/A' ?></p>
                <p><strong>Address:</strong> <?= !empty($user['address']) ? htmlspecialchars($user['address']) : 'N/A' ?></p>
            </div>
        </div>

        <?php if($successMsg) echo "<p class='success-msg'>$successMsg</p>"; ?>
        <?php if($errorMsg) echo "<p class='error-msg'>$errorMsg</p>"; ?>
    </div>

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

    <!-- ================= PROFILE MAIN ================= -->
    <div class="profile-main">
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event,'history')">History</button>
        </div>

       <div id="history" class="tab-content" style="display:block;">
            <?php if(count($allHistory) > 0): ?>
                <div class="cards">
                    <?php foreach($allHistory as $item):
                        $statusColor = ($item['status']=='Purchased' || $item['status']=='Scheduled' || $item['status']=='Submitted') ;
                    ?>
                        <div class="card">
    <h4><?= htmlspecialchars($item['type']) ?></h4>

    <?php if($item['type'] == 'Health Form'): ?>
        <p><strong>User ID:</strong> <?= htmlspecialchars($item['user_id'] ?? 'N/A') ?></p>
        <p><strong>Allergic:</strong> <?= htmlspecialchars($item['q3'] ?? 'None') ?></p>

    <?php elseif($item['type'] == 'Order'): ?>
        <p><strong>Date:</strong> <?= date('d M Y', strtotime($item['date'])) ?></p>
        <p><strong>Details:</strong> <?= htmlspecialchars($item['details']) ?></p>

    <?php elseif($item['type'] == 'Appointment'): ?>
        <p><strong>Date:</strong> <?= date('d M Y', strtotime($item['date'])) ?></p>
        <p><strong>Services:</strong> <?= htmlspecialchars($item['details']) ?></p>
    <?php endif; ?>

    <p><strong>Status:</strong> 
        <span class="status-badge" style="background:<?= $statusColor ?>">
            <?= htmlspecialchars($item['status']) ?>
        </span>
    </p>
</div>

                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No history found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f7f9fc;
    color: #333;
    margin: 0;
    padding: 0;
}

.profile-dashboard {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 160px auto;
    margin-bottom: 30px;
    align-items: stretch; 
    background: linear-gradient(135deg, #e0f2ff, #6b8fc5); /* biru pastel gradient */ 
    padding: 20px; 
    border-radius: 12px;
}

.profile-sidebar, .profile-main {
    flex: 1;
    min-width: 280px;
    display: flex;
    flex-direction: column;
}

.profile-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px; 
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    flex: 1; 
}

.profile-card:hover {
    transform: translateY(-5px);
}

.profile-image img {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    border: 5px solid #4a90e2;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    transition: 0.3s;
}
.profile-image img:hover {
    transform: scale(1.05);
}

.upload-form {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-top: 5px;
}
.upload-form input[type="file"] {
    padding: 6px;
}
.upload-form button {
    padding: 10px 20px;
    background: linear-gradient(135deg,#4a90e2,#357abd);
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}
.upload-form button:hover {
    background: linear-gradient(135deg,#6fa3ef,#4a90e2);
    transform: scale(1.05);
}

.profile-info h3 {
    margin-bottom: 10px;
    color: #1976d2;
    font-size: 22px;
}
.profile-info p {
    text-align: justify;
    font-size: 15px;
    margin: 5px 0;
    color: #555;
}

/* MAIN */
.profile-main {
    flex: 2;
    min-width: 500px;
}

.tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
}
.tab-btn {
    flex: 1;
    padding: 12px;
    cursor: pointer;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    background: #e9edf5;
    transition: 0.3s;
}
.tab-btn.active {
    background: #4a90e2;
    color: white;
}
.tab-btn:hover {
    background: #6fa3ef;
    color: white;
}

.tab-content {
    display: none;
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

/* HISTORY CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(280px,1fr));
    gap: 10px;
}
.card {
    border: 1px solid #eee;
    border-radius: 15px;
    padding: 20px;
    background: #cce0f1;
    transition: 0.3s;
}
.card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    transform: translateY(-
}
.card h4 {
    color: #1976d2;
    margin-bottom: 10px;
}

/* STATUS BADGES */
.status-badge {
    color: white;
    padding: 5px 12px;
    border-radius: 12px;
    font-weight: bold;
    font-size: 12px;
    text-transform: uppercase;
    display: inline-block;
}

/* MESSAGES */
.success-msg {
    color: green;
    text-align: center;
    margin-top: 15px;
    font-weight: 600;
}
.error-msg {
    color: red;
    text-align: center;
    margin-top: 15px;
    font-weight: 600;
}

/* RESPONSIVE */
@media(max-width:900px){
    .profile-dashboard{flex-direction:column;}
    .profile-main{width:100%;}
}
</style>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){ document.getElementById('profilePreview').src = reader.result; }
    reader.readAsDataURL(event.target.files[0]);
}
function openTab(evt, tabName){
    const tabs = document.querySelectorAll('.tab-content');
    const btns = document.querySelectorAll('.tab-btn');
    tabs.forEach(t=>t.style.display='none');
    btns.forEach(b=>b.classList.remove('active'));
    document.getElementById(tabName).style.display='block';
    evt.currentTarget.classList.add('active');
}
</script>

<?php include 'includes/footer.php'; ?>
