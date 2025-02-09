<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product to product page </title>
    <?php
   include './link_file.php';
   ?>
</head>
<body>
    <?php
    include 'headerfix.php'
    ?>
 <?php
 include './dbconfig.php'; // Include your database connection file

 
// Check if form is submitted

if (isset($_POST['submit'])) {
   // Initialize variables with default empty values
   $title = $subject = $price = $description = $flipkart_url = $amazon_url = $indiamart_url = $jiomart_url = '';
   
   // Validate and sanitize form inputs
   if (isset($_POST['Tname'])) {
       $title = mysqli_real_escape_string($conn, $_POST['Tname']);
   }
   if (isset($_POST['subject'])) {
       $subject = mysqli_real_escape_string($conn, $_POST['subject']);
   }
   if (isset($_POST['Pprice'])) {
       $price = mysqli_real_escape_string($conn, $_POST['Pprice']);
   }
   if (isset($_POST['description'])) {
       $description = mysqli_real_escape_string($conn, $_POST['description']);
   }
   if (isset($_POST['flipkart_url'])) {
       $flipkart_url = mysqli_real_escape_string($conn, $_POST['flipkart_url']);
   }
   if (isset($_POST['amazon_url'])) {
       $amazon_url = mysqli_real_escape_string($conn, $_POST['amazon_url']);
   }
   if (isset($_POST['indiamart_url'])) {
       $indiamart_url = mysqli_real_escape_string($conn, $_POST['indiamart_url']);
   }
   if (isset($_POST['jiomart_url'])) {
       $jiomart_url = mysqli_real_escape_string($conn, $_POST['jiomart_url']);
   }

   // Check if all required fields are filled
   if (empty($title) || empty($subject) || empty($price) || empty($description)) {
       echo "<script>alert('Please fill all required fields.');</script>";
   } else {
       // File upload handling
       if (isset($_FILES['Pimage']) && $_FILES['Pimage']['error'] === UPLOAD_ERR_OK) {
           $image_name = $_FILES['Pimage']['name'];
           $image_tmp_name = $_FILES['Pimage']['tmp_name'];
           $image_folder = "productimage/" . $image_name;

           if (move_uploaded_file($image_tmp_name, $image_folder)) {
               // Insert data into the database
               $sql = "INSERT INTO productpage (title, image, subject, price, description, flipkart_url, amazon_url, indiamart_url, jiomart_url)
                       VALUES ('$title', '$image_name', '$subject', '$price', '$description', '$flipkart_url', '$amazon_url', '$indiamart_url', '$jiomart_url')";

               if ($conn->query($sql) === TRUE) {
                   echo "<script>alert('Product uploaded successfully!');</script>";
               } else {
                   echo "<script>alert('Database error: " . $conn->error . "');</script>";
               }
           } else {
               echo "<script>alert('Failed to upload image. Please try again.');</script>";
           }
       } else {
           echo "<script>alert('Please select an image to upload.');</script>";
       }
   }
}

// Handle product removal
if (isset($_GET['remove'])) {
    $productId = intval($_GET['remove']); // Get the product ID from the URL and sanitize it

    // Prepare SQL query to delete the product
    $deleteSql = "DELETE FROM productpage WHERE id = $productId";

    // Execute the delete query
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Product removed successfully!');</script>";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
        exit(); // Terminate script execution after redirect
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch products from the database
$sql = "SELECT * FROM productpage";
$result = $conn->query($sql);



$conn->close();
 ?>


 <div class="container mt-5">
      <header class="d-flex justify-content-between align-items-center mb-4">
         <h1> Upload product File</h1>
         <div class="user-info">
            <p>Welcome, User</p>
            <a href="#">Logout</a>
         </div>
      </header>

<div class="form-container">
         <form action="#" method="POST" enctype="multipart/form-data">
            <!-- Form fields here -->
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Title</label>
                     <input type="text" name="Tname" class="form-control" placeholder="Enter Title">
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Add Product Image</label>
                     <input type="file" name="Pimage" class="form-control">
                  </div>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Product</label>
               <select class="form-select" name="subject" aria-label="Default select example">
                  <option value="" disabled selected hidden>-select subject-</option>
                  <option value="Dish Wash Gel">Dish Wash Gel</option>
                  <option value="Floor Cleaner">Floor Cleaner</option>
                  <option value="Laundry Detergent">Laundry Detergent</option>
                  <option value="Glass Cleaner">Glass Cleaner</option>
               </select>
            </div>

            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Price</label>
                     <input type="text" name="Pprice" class="form-control" placeholder="Enter Final Price">
                  </div>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Description</label>
               <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
            </div>

            <div class="mb-3">
               <label class="form-label">Flipkart Url</label>
               <input class="form-control" type="text" name="flipkart_url" placeholder="Enter Flipkart Url" required>
            </div>

            <div class="mb-3">
               <label class="form-label">Amazon Url</label>
               <input class="form-control" type="text" name="amazon_url" placeholder="Enter Amazon Url" required>
            </div>

            <div class="mb-3">
               <label class="form-label">India Mart Url</label>
               <input class="form-control" type="text" name="indiamart_url" placeholder="Enter India Mart Url" required>
            </div>

            <div class="mb-3">
               <label class="form-label">Jio Mart Url</label>
               <input class="form-control" type="text" name="jiomart_url" placeholder="Enter Jio Mart Url" required>
            </div>

            <div class="col-12">
               <button class="btn btn-primary w-100" type="submit" name="submit" value="submit">Submit</button>
            </div>
         </form>
      </div>

      <div class="mt-5">
            <h2>Uploaded Products</h2>
            <?php
            // Fetch products from the database
            include './dbconfig.php';
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table class="table table-bordered">';
                echo '<thead><tr><th>Title</th><th>Image</th><th>Subject</th><th>Price</th><th>Description</th><th>Flipkart URL</th><th>Amazon URL</th><th>India Mart URL</th><th>Jio Mart URL</th><th>Action</th></tr></thead>';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                    echo '<td><img src="productimage/' . htmlspecialchars($row['image']) . '" alt="Product Image" style="width: 100px; height: auto;"></td>';
                    echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                    echo '<td><a href="' . htmlspecialchars($row['flipkart_url']) . '" target="_blank">View</a></td>';
                    echo '<td><a href="' . htmlspecialchars($row['amazon_url']) . '" target="_blank">View</a></td>';
                    echo '<td><a href="' . htmlspecialchars($row['indiamart_url']) . '" target="_blank">View</a></td>';
                    echo '<td><a href="' . htmlspecialchars($row['jiomart_url']) . '" target="_blank">View</a></td>';
                    echo '<td><a href="?remove=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm">Remove</a></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>