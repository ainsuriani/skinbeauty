<?php
session_start();

/* ===============================
   CONFIG
================================ */
$timeout = 300; // 5 minutes
$public_pages = ['login.php', 'create_account.php', 'logout.php'];

/* ===============================
   CURRENT PAGE
================================ */
$current = basename($_SERVER['PHP_SELF']);

/* ===============================
   AUTO LOGOUT (INACTIVITY)
================================ */
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {
        $_SESSION = [];
        session_destroy();
        header("Location: login.php?timeout=1");
        exit();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}

/* ===============================
   LOGIN PROTECTION
================================ */
if (!isset($_SESSION['user_id']) && !in_array($current, $public_pages)) {
    header("Location: login.php");
    exit();
}

/* ===============================
   HEALTH DECLARATION REDIRECT
================================ */
if (
    isset($_SESSION['user_id']) &&
    (!isset($_SESSION['health_done']) || $_SESSION['health_done'] === false) &&
    $current !== 'health_declaration.php' &&
    $current !== 'logout.php'
) {
    header("Location: health_declaration.php");
    exit();
}
?>
