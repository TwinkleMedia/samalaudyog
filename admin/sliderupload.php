<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary files
include './dbconfig.php'; // Database connection
include './link_file.php';
include './headerfix.php';

// Handle file upload logic
if (isset($_POST['submit'])) {
    if (isset($_FILES['Pimage']) && $_FILES['Pimage']['error'] == 0) {
        
        // Define upload directory
        $target_dir = "uploads/";

        // Create directory if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Get file details
        $file_name = basename($_FILES['Pimage']['name']);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . time() . "_" . $file_name; // Unique filename

        // Allowed file types
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_type, $valid_extensions)) {
            if (move_uploaded_file($_FILES['Pimage']['tmp_name'], $target_file)) {
                
                // Insert into database
                $sql = "INSERT INTO slider_images (image_name, image_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $file_name, $target_file);

                if ($stmt->execute()) {
                    header("Location: sliderupload.php?upload=success");
                    exit();
                } else {
                    echo "<script>alert('Error: Could not save file info in DB.');</script>";
                }
            } else {
                echo "<script>alert('Error: Could not move uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Error: Invalid file type. Allowed: JPG, JPEG, PNG, GIF.');</script>";
        }
    } else {
        echo "<script>alert('Error: No file uploaded.');</script>";
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']); // Sanitize input

    // Fetch image path
    $stmt = $conn->prepare("SELECT image_path FROM slider_images WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $imagePath = $row['image_path'];

        // Delete file from server
        if (!empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete from database
        $stmt = $conn->prepare("DELETE FROM slider_images WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            header("Location: sliderupload.php?delete=success");
            exit();
        } else {
            echo "<script>alert('Error: Could not delete file from database.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Slider Image</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container mt-5">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1>Slider Upload</h1>
        <div class="user-info">
            <p>Welcome, User</p>
            <a href="./form/logout.php">Logout</a>
        </div>
    </header>

    <div class="card p-4 mb-5">
        <form action="sliderupload.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Add Image</label>
                    <input type="file" name="Pimage" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100 mt-4" type="submit" name="submit">Upload</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card p-4">
        <h2 class="mb-4">Uploaded Images</h2>
        <?php
        // Fetch images from database
        $sql = "SELECT * FROM slider_images ORDER BY uploaded_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="table-dark"><tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Image Name</th>
                    <th>Uploaded At</th>
                    <th>Action</th>
                  </tr></thead><tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td><img src="' . htmlspecialchars($row['image_path']) . '" width="100"></td>
                        <td>' . htmlspecialchars($row['image_name']) . '</td>
                        <td>' . htmlspecialchars($row['uploaded_at']) . '</td>
                        <td><a href="sliderupload.php?delete=' . htmlspecialchars($row['id']) . '" 
                               class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a></td>
                      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No images uploaded yet.</p>';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Display success messages
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('upload') === 'success') {
        alert('File uploaded successfully!');
    } else if (urlParams.get('delete') === 'success') {
        alert('Image deleted successfully!');
    }
</script>

</body>
</html>
