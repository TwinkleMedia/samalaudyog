<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>uploadfile</title>
   <?php
   include './link_file.php';
   ?>
</head>

<body>
   <?php
   include './headerfix.php';
   include './dbconfig.php'; // Include your database connection file

   // Handle file upload logic
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
                  // Redirect to the same page with a success parameter
                  header("Location: sliderupload.php?upload=success");
                  exit();
               } else {
                  echo "<script>alert('Error: Could not save file information to the database.');</script>";
               }
            } else {
               echo "<script>alert('Error: There was an error moving the uploaded file.');</script>";
            }
         } else {
            echo "<script>alert('Error: Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
         }
      } else {
         echo "<script>alert('Error: No file was uploaded.');</script>";
      }
   }



   // Handle deletion logic
   if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];

      // Fetch image path to delete the file from the directory
      $stmt = $conn->prepare("SELECT image_path FROM slider_images WHERE id = ?");
      $stmt->bind_param("i", $delete_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if ($row) {
         // Delete the file from the server
         if (file_exists($row['image_path'])) {
            unlink($row['image_path']);
         }

         // Delete the record from the database
         $stmt = $conn->prepare("DELETE FROM slider_images WHERE id = ?");
         $stmt->bind_param("i", $delete_id);

         if ($stmt->execute()) {
            // Redirect to the same page after deletion
            header("Location: sliderupload.php?delete=success");
            exit();
         } else {
            echo "<script>alert('Error: Could not delete the file from the database.');</script>";
         }
      }
   }
   ?>
 
 <div class="container mt-5">
      <header class="d-flex justify-content-between align-items-center mb-4">
         <h1>Slider Upload File</h1>
         <div class="user-info">
            <p>Welcome, User</p>
            <a href="./form/logout.php">Logout</a>
         </div>
      </header>

      <div class="card p-4 mb-5">
         <form action="sliderupload.php" method="POST" enctype="multipart/form-data">
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Add Product Image</label>
                     <input type="file" name="Pimage" class="form-control">
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="mb-3">
                     <label class="form-label">&nbsp;</label>
                     <button class="btn btn-primary w-100" type="submit" name="submit" value="submit">Submit</button>
                  </div>
               </div>
            </div>
         </form>
      </div>

      <!-- Display uploaded images and information in a table -->
      <div class="card p-4">
         <h2 class="mb-4">Uploaded Slider Images</h2>
         <?php
         // Fetch and display the uploaded images from the database
         $sql = "SELECT * FROM slider_images ORDER BY uploaded_at DESC";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="table-dark">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Image</th>';
            echo '<th>Image Name</th>';
            echo '<th>Image Path</th>';
            echo '<th>Uploaded At</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
               echo '<tr>';
               echo '<td>' . htmlspecialchars($row['id']) . '</td>';
               echo '<td><img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['image_name']) . '" style="width: 100px;"></td>';
               echo '<td>' . htmlspecialchars($row['image_name']) . '</td>';
               echo '<td>' . htmlspecialchars($row['image_path']) . '</td>';
               echo '<td>' . htmlspecialchars($row['uploaded_at']) . '</td>';
               echo '<td>';
               echo '<a href="sliderupload.php?delete=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this image?\')">Delete</a>';
               echo '</td>';
               echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
         } else {
            echo '<p>No images found.</p>';
         }
         ?>
      </div>
   </div>

   <?php include './jslinkfile.php'; ?>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script>
      // Check if there is a query parameter "upload=success" and display an alert
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('upload') === 'success') {
         alert('File has been uploaded successfully!');
      }
   </script>
</body>

</html>
