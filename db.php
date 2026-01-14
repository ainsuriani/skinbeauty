<?php
$servername = "localhost";
$username = "root";        // default for XAMPP/WAMP
$password = "";            // leave empty unless you set one
$dbname = "skinbeauty_db"; // must match your phpMyAdmin database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
