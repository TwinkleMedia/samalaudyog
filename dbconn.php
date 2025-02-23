<?php
$servername = "localhost";
$username = "root";
$password = "Samala@0118";
$dbname = "samalaudyog";

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4"); // Set character set for better compatibility
} catch (Exception $e) {
    exit("Connection failed: " . $e->getMessage());
}

// Make $conn global so it can be accessed in other files
global $conn;
?>




