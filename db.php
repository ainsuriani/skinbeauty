<?php
$servername = "localhost";
$username   = "root";        // default phpMyAdmin user
$password   = "";            // leave empty unless you set one
$dbname     = "skinbeauty_db"; // must match the database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
