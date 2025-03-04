<?php
session_start();
include '../dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from form
    $username = trim($_POST['username']);
    $userpassword = trim($_POST['password']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($userpassword, $row['userpassword'])) {
            $_SESSION['username'] = $username; // Set session variable
            echo "<script>alert('Login successful! Redirecting...');</script>";
            echo "<script>window.location.href = '../uploadfile.php';</script>"; // Redirect to uploadfile.php
            exit();
        }
    }

    // Failed login
    echo "<script>alert('Invalid username or password'); window.location.href = '../login.php';</script>";

    $stmt->close();
    $conn->close(); // Close connection
}
?>
