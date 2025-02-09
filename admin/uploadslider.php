<?php
// Include your database connection file
include './dbconfig.php';

if (isset($_POST['submit'])) {
    // Check if a file was uploaded without errors
    if (isset($_FILES['Pimage']) && $_FILES['Pimage']['error'] == 0) {

        // Directory where you want to save the uploaded file
        $target_dir = "uplord/";

        // Create the directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Get the file info
        $file_name = basename($_FILES['Pimage']['name']);
        $target_file = $target_dir . $file_name;

        // Check if the file is valid (add more checks as needed)
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_type, $valid_extensions)) {
            // Move the file to the target directory
            if (move_uploaded_file($_FILES['Pimage']['tmp_name'], $target_file)) {
                // Insert the file information into the database
                $sql = "INSERT INTO slider_images (image_name, image_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $file_name, $target_file);

                if ($stmt->execute()) {
                    echo "File has been uploaded and saved to the database.";
                    header("Location: sliderupload.php?upload=success");
                    exit(); 
                } else {
                    echo "Error: Could not save file information to the database.";
                }
            } else {
                echo "Error: There was an error moving the uploaded file.";
            }
        } else {
            echo "Error: Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error: No file was uploaded.";
    }
}
?>
