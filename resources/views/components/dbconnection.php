<?php
// Database configuration
$host = "localhost";       // Host name (karaniwan localhost)
$dbName = "web_projects"; // Palitan ng pangalan ng database mo
$username = "root";        // Database username
$password = "";            // Database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set charset to utf8
$conn->set_charset("utf8");

?>
