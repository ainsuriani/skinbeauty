<?php
// Include the database connection
include 'db.php';

// Simple test query: get all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result) {
    echo "✅ Connected to database successfully!<br>";
    echo "Found " . $result->num_rows . " users:<br><br>";

    // Loop through results
    while($row = $result->fetch_assoc()) {
        echo "User ID: " . $row['user_id'] . " | Name: " . $row['full_name'] . " | Email: " . $row['email'] . "<br>";
    }
} else {
    echo "❌ Query failed: " . $conn->error;
}
?>
