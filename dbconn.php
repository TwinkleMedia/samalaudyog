<?php
$servername = "localhost"; // or your GoDaddy database host
$username = "samalaudyog"; // Check in GoDaddy's cPanel under MySQL Databases
$password = "Samala@0118"; // Your actual database password
$dbname = "samalaudyog"; // This is your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

global $conn;

?>




