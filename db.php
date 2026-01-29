<?php
$servername = "localhost";
$username   = "root";        // default user
$password   = "";            // default password (empty)
$dbname     = "skinbeauty_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
