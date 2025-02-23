<?php
$servername = "localhost";
$username = "samalaudyog";
$password = "Samala@0118";
$dbname = "samalaudyog";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make $conn global so it can be accessed in other files
global $conn;
?>

