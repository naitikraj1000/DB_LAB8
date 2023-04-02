<?php
// Connect to the database
$servername = "localhost";
$username = "naitik";
$password = "naitik";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete last record from users table
$sql = "DELETE FROM users WHERE id = (SELECT max_id FROM (SELECT MAX(id) AS max_id FROM users) AS t)";


if ($conn->query($sql) === TRUE) {
    echo "Last record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close database connection
$conn->close();
?>

