<?php  
  ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Upload File</title>
   <?php include './link_file.php'; ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
   
   <style>
      /* Custom styles to ensure proper spacing */
      .container {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }

      .form-container {
         margin-bottom: 40px; /* Space between form and table */
      }

      .table-container {
         margin-top: 20px;
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
         .table-container {
            margin-top: 10px;
         }
      }
   </style>
</head>

<body>
   <?php include './headerfix.php'; ?>

   <?php
  

   // Include database configuration file
   include './dbconfig.php'; // Adjust the path based on your folder structure
 if (isset($_GET['delete_id'])) {
   $deleteId = intval($_GET['delete_id']); // Sanitize input

   // Step 1: Fetch the image paths from the `product_images` table
   $selectImagesQuery = "SELECT image_path FROM product_images WHERE product_id = ?";

   $stmt = $conn->prepare($selectImagesQuery); // Use the correct variable name
   $stmt->bind_param("i", $deleteId);
   $stmt->execute();
   $stmt->bind_result($imagePath);

   // Delete image files from the server
   while ($stmt->fetch()) {
       if (file_exists($imagePath)) {
           unlink($imagePath); // Delete the image file
       }
   }
   $stmt->close();

   // Step 2: Delete image records from the `product_images` table
   $deleteImagesQuery = "DELETE FROM product_images WHERE product_id = ?";
   $imageStmt = $conn->prepare($deleteImagesQuery);
   $imageStmt->bind_param("i", $deleteId);
   $imageStmt->execute();
   $imageStmt->close();

   // Step 3: Delete the product record from the `allproducts` table
   $deleteProductQuery = "DELETE FROM allproducts WHERE id = ?";
   $productStmt = $conn->prepare($deleteProductQuery);
   $productStmt->bind_param("i", $deleteId);
   if ($productStmt->execute()) {
       echo "<script>alert('Product deleted successfully!');</script>";
       echo "<script>window.location.href = 'uploadfile.php';</script>"; // Refresh the page
   } else {
       echo "<script>alert('Error deleting product: {$productStmt->error}');</script>";
   }
   $productStmt->close();
}

// Fetch all products
$sql = "SELECT 
            p.id, p.title, p.subject, p.discounted_price, p.final_price, p.description,
            p.flipkart_url, p.amazon_url, p.indiamart_url, p.jiomart_url,
            GROUP_CONCAT(pi.image_path) AS product_images
        FROM allproducts p
        LEFT JOIN product_images pi ON p.id = pi.product_id
        GROUP BY p.id";
$result = $conn->query($sql);




   ?>

  <div class="container">
      <header class="topbar">
         <h1>Upload File</h1>
         <div class="user-info">
            <p>Welcome, User</p>
            <a href="#">Logout</a>
         </div>
      </header>
      <div class="form-container">
   <form action="allproductupload.php" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-12 col-md-6">
            <div class="mb-3">
               <label class="form-label">Title</label>
               <input type="text" name="Tname" class="form-control" placeholder="Enter Title" required>
            </div>
         </div>
         <div class="mb-3">
            <label class="form-label">Front Side Image</label>
            <input type="file" name="front_image" class="form-control" required>
         </div>

         <div class="mb-3">
            <label class="form-label">Back Side Image</label>
            <input type="file" name="back_image" class="form-control" required>
         </div>

         <div class="mb-3">
            <label class="form-label">Details Image</label>
            <input type="file" name="details_image" class="form-control" required>
         </div>

         <div class="mb-3">
            <label class="form-label">Extra Image</label>
            <input type="file" name="extra_image" class="form-control" required>
         </div>
      </div>

      <div class="mb-3">
         <label class="form-label">Subject</label>
         <select class="form-select" name="subject" required>
            <option value="" disabled selected hidden>-select subject-</option>
            <option value="HOME CARE">HOME CARE</option>
            <option value="PERSONAL CARE">PERSONAL CARE</option>
            <option value="HOSPITAL CARE">HOSPITAL CARE</option>
            <option value="SPECIALITY CHEMICALS">SPECIALITY CHEMICALS</option>
         </select>
      </div>

      <div class="row">
         <div class="col-12 col-md-6">
            <div class="mb-3">
               <label class="form-label">Discounted Price</label>
               <input type="text" name="Dprice" class="form-control" placeholder="Enter Discounted Price" required>
            </div>
         </div>
         <div class="col-12 col-md-6">
            <div class="mb-3">
               <label class="form-label">MRP Price</label>
               <input type="text" name="Pprice" class="form-control" placeholder="Enter Final Price" required>
            </div>
         </div>
      </div>

      <div class="mb-3">
         <label class="form-label">Description</label>
         <textarea class="form-control" name="description" rows="3" placeholder="Description" required></textarea>
      </div>

      <div class="mb-3">
         <label class="form-label">Flipkart Url</label>
         <input class="form-control" type="text" name="flipkart_url" placeholder="Enter Flipkart Url">
      </div>

      <div class="mb-3">
         <label class="form-label">Amazon Url</label>
         <input class="form-control" type="text" name="amazon_url" placeholder="Enter Amazon Url">
      </div>

      <div class="mb-3">
         <label class="form-label">India Mart Url</label>
         <input class="form-control" type="text" name="indiamart_url" placeholder="Enter India Mart Url">
      </div>

      <div class="mb-3">
         <label class="form-label">Jio Mart Url</label>
         <input class="form-control" type="text" name="jiomart_url" placeholder="Enter Jio Mart Url">
      </div>

      <div class="col-12">
         <button class="btn btn-primary w-100" type="submit" name="submit" value="submit">Submit</button>
      </div>
   </form>
</div>

<div class="container my-4">
    <h2 class="text-center mb-4">Product List</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subject</th>
                <th>Discounted Price</th>
                <th>Final Price</th>
                <th>Description</th>
                <th>Product Images</th>
                <th>Flipkart URL</th>
                <th>Amazon URL</th>
                <th>IndiaMart URL</th>
                <th>JioMart URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Decode the concatenated image paths into an array
                    $images = !empty($row['product_images']) ? explode(',', $row['product_images']) : [];
                    
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['subject']}</td>
                            <td>{$row['discounted_price']}</td>
                            <td>{$row['final_price']}</td>
                            <td>{$row['description']}</td>
                            <td>";
                    // Display product images
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            echo "<img src='$image' alt='Product Image' style='width: 50px; height: 50px; margin-right: 5px;'>";
                        }
                    } else {
                        echo "No Images";
                    }
                    echo "</td>
                            <td><a href='{$row['flipkart_url']}' target='_blank'>Flipkart</a></td>
                            <td><a href='{$row['amazon_url']}' target='_blank'>Amazon</a></td>
                            <td><a href='{$row['indiamart_url']}' target='_blank'>IndiaMart</a></td>
                            <td><a href='{$row['jiomart_url']}' target='_blank'>JioMart</a></td>
                            <td>
                                <a href='?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                              <a href='editproduct.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='12' class='text-center'>No Products Found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>
