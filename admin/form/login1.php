<?php
session_start();
include '../dbconfig.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query to check if user exists with plain text password
    $sql = "SELECT * FROM admin_users WHERE username = '$username' AND userpassword = '$userpassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['username'] = $username; // Set session variable
        echo "<script>alert('Login successful! Redirecting...');</script>";
        echo "<script>window.location.href = '../uploadfile.php';</script>"; // Redirect to uploadfile.php
    } else {
        // Failed login
        echo "<script>alert('Invalid username or password');</script>";
    }

    $conn->close(); // Close connection
}
?>
