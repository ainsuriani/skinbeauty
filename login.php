<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($user['password'] === $password) { // demo only
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['health_done'] = true;

            header("Location: home.php");
            exit();
        } else {
            $error = "❌ Incorrect password";
        }
    } else {
        $error = "❌ Account not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Skin Beauty Clinic</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin:0; padding:0; }

/* ===== BODY & BLURRED BACKGROUND ===== */
body {
    font-family: 'Quicksand', sans-serif;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    position: relative;
    overflow: hidden;
    background: #e0f2fe;
}

body::before {
    content: '';
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: url('images/banner.jpg') center/cover no-repeat;
    filter: blur(6px) brightness(0.7);
    z-index: -1;
}

/* ===== LOGIN CARD ===== */
.login-card {
    position: relative;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(14px);
    padding: 50px 35px 35px 35px;
    border-radius: 25px;
    max-width: 400px;
    width: 100%;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 35px 80px rgba(0,0,0,0.35);
}

/* ===== TITLE ===== */
.login-card h1 {
    font-family: 'Pacifico', cursive;
    font-size: 38px;
    color: #4a90e2;
    margin-bottom: 25px;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
}

/* ===== ERROR ===== */
.error {
    color: #ff4d4f;
    font-weight: bold;
    margin-bottom: 15px;
}

/* ===== INPUTS WITH FLOATING LABELS ===== */
.input-wrapper {
    position: relative;
    margin-bottom: 20px;
}

.input-wrapper input {
    width: 100%;
    padding: 14px 45px 14px 15px;
    border-radius: 12px;
    border: 1px solid #ddd;
    font-size: 16px;
    background: #f9f9f9;
    height: 50px;
    transition: all 0.3s ease;
}

.input-wrapper input:focus {
    outline:none;
    box-shadow: 0 0 10px rgba(74,144,226,0.25);
}

/* Floating labels */
.input-wrapper label {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
    transition: all 0.35s ease, transform 0.35s ease;
    background: transparent;
    padding: 0 5px;
    font-weight: 600;
    font-size: 16px;
}

/* When focused or filled */
.input-wrapper input:focus + label,
.input-wrapper input:not(:placeholder-shown) + label {
    top: -10px;
    left: 12px;
    font-size: 13px;
    background: white;
    padding: 0 6px;

    /* Gradient text */
    background: linear-gradient(90deg, #4a90e2, #60a5fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    /* Slight scale and shadow */
    transform: translateY(0) scale(1.05);
    text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
}

/* ===== PASSWORD PEEK ICON ===== */
.input-wrapper .toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    width: 22px;
    height: 22px;
    fill: #4a90e2;
    transition: all 0.3s ease;
}
.input-wrapper .toggle-password:hover { fill:#6fa3ef; }

/* ===== BUTTON ===== */
.login-card button {
    width: 100%;
    padding: 16px;
    margin-top: 15px;
    border: none;
    border-radius: 30px;
    background: linear-gradient(135deg, #4a90e2, #6fa3ef);
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
.login-card button:hover {
    background: linear-gradient(135deg, #6fa3ef, #4a90e2);
    transform: translateY(-2px);
}

/* ===== REGISTER LINK ===== */
.register-link {
    margin-top: 18px;
    font-size: 14px;
}
.register-link a {
    color: #4a90e2;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}
.register-link a:hover {
    color: #6fa3ef;
    text-decoration: underline;
}

/* ===== RESPONSIVE ===== */
@media(max-width: 450px){
    .login-card { padding: 40px 25px 25px 25px; }
    .login-card h1 { font-size: 30px; }
    .input-wrapper input { height: 45px; }
}
</style>
</head>
<body>

<div class="login-card">
    <h1>Skin Beauty Clinic</h1>
    <?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
    <form method="POST" autocomplete="off">
        <!-- Email -->
        <div class="input-wrapper">
            <input type="email" name="email" placeholder=" " required>
            <label>Email</label>
        </div>

        <!-- Password -->
        <div class="input-wrapper">
            <input type="password" name="password" id="password" placeholder=" " required>
            <label>Password</label>
            <!-- Professional SVG eye icon -->
            <svg class="toggle-password" id="togglePassword" viewBox="0 0 24 24">
                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
                <circle cx="12" cy="12" r="2.5"/>
            </svg>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">No account? <a href="create_account.php">Register here</a></div>
</div>

<script>
// Password toggle
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

togglePassword.addEventListener('click', () => {
    password.type = password.type === 'password' ? 'text' : 'password';
});
</script>

</body>
</html>
