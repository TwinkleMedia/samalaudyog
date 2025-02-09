<?php
$servername = "localhost";
$username = "u694280384_samalaDemoDB";
$password = "Samalapass@123";
$dbname = "u694280384_samalaDemoDB";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make $conn global so it can be accessed in other files
global $conn;
?>