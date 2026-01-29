<?php
session_start();

/* Clear session */
$_SESSION = [];
session_destroy();

/* Destroy session cookie */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out - Skin Beauty Clinic</title>
  <meta http-equiv="refresh" content="5;url=login.php">
  <style>
    body {
      margin: 0;
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(135deg, #eaf4fc, #d0e7ff);
    }

    .logout-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .logout-card {
      background: white;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    .logout-card h2 {
      color: #4a90e2;
      font-size: 28px;
      margin-bottom: 15px;
    }

    .logout-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 25px;
      background: #4a90e2;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 30px;
    }

    .logout-btn:hover {
      background: #6fa3ef;
    }
  </style>
</head>
<body>

<div class="logout-container">
  <div class="logout-card">
    <h2>You’ve been logged out 💙</h2>
    <p>Thank you for visiting Skin Beauty Clinic.</p>
    <p>You will be redirected shortly.</p>

    <a href="login.php" class="logout-btn">Log In Again</a>
  </div>
</div>

</body>
</html>
