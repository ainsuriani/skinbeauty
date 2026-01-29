<?php
session_start();
include 'db.php';

$error = "";

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);
    $password  = trim($_POST['password']); // demo only

    $q1 = trim($_POST['q1']);
    $q2 = trim($_POST['q2']);
    $q3 = trim($_POST['q3']);

    $stmt = $conn->prepare(
      "INSERT INTO users (full_name,email,phone,address,password) VALUES (?,?,?,?,?)"
    );
    $stmt->bind_param("sssss", $full_name, $email, $phone, $address, $password);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;

        $stmt2 = $conn->prepare(
          "INSERT INTO health_declaration (user_id,q1,q2,q3) VALUES (?,?,?,?)"
        );
        $stmt2->bind_param("isss", $user_id, $q1, $q2, $q3);
        $stmt2->execute();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['health_done'] = true;

        header("Location: home.php");
        exit();
    } else {
        $error = "❌ Registration failed, try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account & Health Declaration</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; }

/* ===== BODY & BLURRED BACKGROUND ===== */
body {
    margin: 0;
    min-height: 100vh;
    font-family: 'Quicksand', sans-serif;
    position: relative;
    overflow-y: auto;  /* enable vertical scroll if needed */
    padding: 40px 20px;

    /* Gradient animation */
    background: linear-gradient(-45deg, #dbeafe, #e0f2fe, #f0f9ff, #dbeafe);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
}

/* Gradient keyframes */
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Blurred background image overlay */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; 
    height: 100%;
    background: url('images/banner.jpg') center/cover no-repeat;
    background-size: cover;
    background-attachment: fixed;
    filter: blur(8px) brightness(0.6); /* blur + dark overlay */
    z-index: -1; /* behind content */
}

/* ===== REGISTER CARD ===== */
.register-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(12px);
    padding: 45px 38px;
    border-radius: 24px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    max-width: 520px;
    width: 100%;
}

.register-card h2 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 30px;
}

.register-card h3 {
    margin-top: 30px;
    color: #2563eb;
    font-size: 18px;
    border-left: 4px solid #2563eb;
    padding-left: 10px;
}

.input-group {
    margin-bottom: 18px;
}

.input-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    font-size: 14px;
}

.register-card input,
.register-card select,
.register-card textarea {
    width: 100%;
    padding: 13px 16px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    font-size: 15px;
}

.register-card input:focus,
.register-card select:focus,
.register-card textarea:focus {
    border-color: #2563eb;
    outline: none;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
}

/* Health section */
.health-section {
    background: #eff6ff;
    padding: 20px;
    border-radius: 16px;
}

/* Password styling */
.password-wrap { position: relative; }
.password-toggle {
    font-size: 13px;
    font-weight: 600;
    color: #2563eb;
    cursor: pointer;
    user-select: none;
    margin-top: 6px;
}
.password-toggle:hover { text-decoration: underline; }

/* Password rules */
.password-rules { list-style: none; padding-left: 0; margin-top: 8px; font-size: 13px; }
.password-rules li { color: #9ca3af; }
.password-rules li.valid { color: #16a34a; }

#confirm-message { font-size: 13px; color: #9ca3af; margin-top: 5px; }
#confirm-message.valid { color: #16a34a; }

/* Button */
.register-card button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 30px;
    background: #2563eb;
    color: white;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    margin-top: 25px;
}

.register-card button:hover { background: #1e40af; }

/* Error message */
.error { color: #dc2626; text-align: center; margin-bottom: 15px; }

/* Footer */
.footer { text-align: center; margin-top: 20px; font-size: 14px; }
.footer a { color: #2563eb; text-decoration: none; font-weight: 700; }
.footer a:hover { text-decoration: underline; }

.register-card {
    margin: 0 auto; /* center horizontally */
}

</style>
</head>
<body>

<div class="register-card">
  <h2>Create Account & Health Declaration</h2>

  <?php if($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST">
    <h3>Account Info</h3>

    <div class="input-group">
      <label>Full Name</label>
      <input type="text" name="full_name" required>
    </div>

    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" placeholder="user@gmail.com" required>
    </div>

    <div class="input-group">
      <label>Phone</label>
      <input type="text" name="phone">
    </div>

    <div class="input-group">
      <label>Address</label>
      <input type="text" name="address">
    </div>

    <!-- Password -->
    <div class="input-group">
      <label>Password</label>
      <div class="password-wrap">
        <input type="password" id="password" name="password" required>
        <span class="password-toggle" onclick="togglePasswords()">Show</span>
      </div>
      <ul class="password-rules" id="rules">
        <li id="len">• At least 8 characters</li>
        <li id="upper">• At least 1 uppercase letter</li>
        <li id="lower">• At least 1 lowercase letter</li>
        <li id="number">• At least 1 number</li>
      </ul>
    </div>

    <!-- Confirm Password -->
    <div class="input-group">
      <label>Confirm Password</label>
      <div class="password-wrap">
        <input type="password" id="confirm_password" required>
        <span class="password-toggle" onclick="togglePasswords()">Show</span>
      </div>
      <p id="confirm-message">• Must match password</p>
    </div>

    <!-- Health Declaration -->
    <h3>Health Declaration</h3>
    <div class="health-section">
      <div class="input-group">
        <label>Chronic illness?</label>
        <select name="q1" required>
          <option value="">Select</option>
          <option>Yes</option>
          <option>No</option>
        </select>
      </div>
      <div class="input-group">
        <label>Taking medication?</label>
        <select name="q2" required>
          <option value="">Select</option>
          <option>Yes</option>
          <option>No</option>
        </select>
      </div>
      <div class="input-group">
        <label>Allergies</label>
        <textarea name="q3" rows="2" required></textarea>
      </div>
    </div>

    <button type="submit">Register & Submit</button>
  </form>

  <p class="footer">Already have an account? <a href="login.php">Log In here</a></p>
</div>

<script>
function togglePasswords() {
  const p = document.getElementById("password");
  const c = document.getElementById("confirm_password");
  const toggles = document.querySelectorAll(".password-toggle");

  const show = p.type === "password";
  p.type = show ? "text" : "password";
  c.type = show ? "text" : "password";

  toggles.forEach(t => t.textContent = show ? "Hide" : "Show");
}

// Live password validation
const password = document.getElementById("password");
const confirm_password = document.getElementById("confirm_password");
const confirmMsg = document.getElementById("confirm-message");

password.addEventListener("input", validatePassword);
confirm_password.addEventListener("input", validateConfirm);

function validatePassword() {
  toggleRule("len", password.value.length >= 8);
  toggleRule("upper", /[A-Z]/.test(password.value));
  toggleRule("lower", /[a-z]/.test(password.value));
  toggleRule("number", /\d/.test(password.value));
  validateConfirm();
}

function validateConfirm() {
  const match = confirm_password.value === password.value && confirm_password.value !== "";
  confirmMsg.classList.toggle("valid", match);
}

function toggleRule(id, valid) {
  document.getElementById(id).classList.toggle("valid", valid);
}

// Final submit check
document.querySelector("form").addEventListener("submit", function(e) {
  const pw = password.value;
  const cpw = confirm_password.value;
  const rulesValid = pw.length >= 8 && /[A-Z]/.test(pw) && /[a-z]/.test(pw) && /\d/.test(pw);
  const confirmValid = pw === cpw;

  if (!rulesValid) {
    e.preventDefault();
    alert("Password does not meet the requirements");
  } else if (!confirmValid) {
    e.preventDefault();
    alert("Confirm password does not match");
  }
});
</script>

</body>
</html>
