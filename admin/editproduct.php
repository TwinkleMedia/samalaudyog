<?php
include './dbconfig.php';

// Get product ID
$product_id = intval($_GET['id']);

// Fetch product details
$query = "SELECT * FROM allproducts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $discounted_price = $_POST['discounted_price'] ?? 0;
    $final_price = $_POST['final_price'] ?? 0;
    $description = $_POST['description'] ?? '';
    $flipkart_url = $_POST['flipkart_url'] ?? '';
    $amazon_url = $_POST['amazon_url'] ?? '';
    $indiamart_url = $_POST['indiamart_url'] ?? '';
    $jiomart_url = $_POST['jiomart_url'] ?? '';

    // Define the update query
    $update_query = "UPDATE allproducts 
                     SET title = ?, subject = ?, discounted_price = ?, final_price = ?, 
                         description = ?, flipkart_url = ?, amazon_url = ?, 
                         indiamart_url = ?, jioMart_url = ?
                     WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);

    // Bind parameters to the query
    $update_stmt->bind_param(
        "ssddsssssi", 
        $title,
        $subject,
        $discounted_price,
        $final_price,
        $description,
        $flipkart_url,
        $amazon_url,
        $indiamart_url,
        $jiomart_url,
        $product_id
    );

    // Execute the query
    if ($update_stmt->execute()) {
        echo "<script>alert('Product updated successfully!');</script>";
        echo "<script>window.location.href = 'uploadfile.php';</script>";
    } else {
        echo "<script>alert('Error updating product: {$update_stmt->error}');</script>";
    }
    $update_stmt->close();
}
if (isset($_POST['update_images'])) {
    $upload_path = './allproductsimages/'; // Make sure this directory exists and is writable
    
    // Get all current images for the product
    $query = "SELECT id, image_path FROM product_images WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_images = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    // Process each uploaded image
    $image_fields = ['front_image', 'back_image', 'details_image', 'extra_image'];
    
    foreach ($image_fields as $index => $field) {
        if (!empty($_FILES[$field]['name'])) {
            // Delete old image if it exists
            if (isset($current_images[$index]) && file_exists($current_images[$index]['image_path'])) {
                unlink($current_images[$index]['image_path']);
            }
            
            // Process new image upload
            $file_extension = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '_' . $field . '.' . $file_extension;
            $upload_destination = $upload_path . $new_filename;
            
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $upload_destination)) {
                if (isset($current_images[$index])) {
                    // Update existing record
                    $update_query = "UPDATE product_images SET image_path = ? WHERE id = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->bind_param("si", $upload_destination, $current_images[$index]['id']);
                    $update_stmt->execute();
                    $update_stmt->close();
                } else {
                    // Insert new record
                    $insert_query = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
                    $insert_stmt = $conn->prepare($insert_query);
                    $insert_stmt->bind_param("is", $product_id, $upload_destination);
                    $insert_stmt->execute();
                    $insert_stmt->close();
                }
            }
        }
    }
    
    echo "<script>alert('Images updated successfully!');</script>";
    echo "<script>window.location.href = 'uploadfile.php';</script>";
}

// Fetch current images for the product
$images_query = "SELECT id, image_path FROM product_images WHERE product_id = ? ORDER BY id ASC";
$images_stmt = $conn->prepare($images_query);
$images_stmt->bind_param("i", $product_id);
$images_stmt->execute();
$images_result = $images_stmt->get_result();
$current_images = $images_result->fetch_all(MYSQLI_ASSOC);
$images_stmt->close();
?>

<!-- HTML Form for Editing Product -->
<style>
    /* Add a background color and some padding to the page */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 20px;
    }

    /* Style for the form container */
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Styling for form labels */
    label {
        font-weight: bold;
        margin-top: 10px;
        display: block;
        font-size: 14px;
        color: #333;
    }

    /* Styling for input fields and textarea */
    input[type="text"],
    input[type="number"],
    input[type="url"],
    textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
        box-sizing: border-box;
    }

    /* Focus effect on inputs */
    input:focus,
    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Style for the submit button */
    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Hover effect on button */
    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Add responsive design for mobile screens */
    @media (max-width: 600px) {
        form {
            width: 100%;
            padding: 15px;
        }
    }
</style>

<form method="POST">
    
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($product['title']) ?>" required>

    <label for="subject">Subject:</label>
    <input type="text" name="subject" id="subject" value="<?= htmlspecialchars($product['subject']) ?>" required>

    <label for="discounted_price">Discounted Price:</label>
    <input type="number" step="0.01" name="discounted_price" id="discounted_price" value="<?= htmlspecialchars($product['discounted_price']) ?>" required>

    <label for="final_price">Final Price:</label>
    <input type="number" step="0.01" name="final_price" id="final_price" value="<?= htmlspecialchars($product['final_price']) ?>" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label for="flipkart_url">Flipkart URL:</label>
    <input type="url" name="flipkart_url" id="flipkart_url" value="<?= htmlspecialchars($product['flipkart_url']) ?>">

    <label for="amazon_url">Amazon URL:</label>
    <input type="url" name="amazon_url" id="amazon_url" value="<?= htmlspecialchars($product['amazon_url']) ?>">

    <label for="indiamart_url">IndiaMart URL:</label>
    <input type="url" name="indiamart_url" id="indiamart_url" value="<?= htmlspecialchars($product['indiamart_url']) ?>">

    
    <button type="submit">Update Product</button>
</form>
<form method="POST" enctype="multipart/form-data" class="mt-4">
    <h3>Update Product Images</h3>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Front Image</label>
            <?php if (isset($current_images[0])): ?>
                <img src="<?= htmlspecialchars($current_images[0]['image_path']) ?>" 
                     class="img-thumbnail mb-2" style="max-width: 150px">
            <?php endif; ?>
            <input type="file" name="front_image" class="form-control" accept="image/*">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Back Image</label>
            <?php if (isset($current_images[1])): ?>
                <img src="<?= htmlspecialchars($current_images[1]['image_path']) ?>" 
                     class="img-thumbnail mb-2" style="max-width: 150px">
            <?php endif; ?>
            <input type="file" name="back_image" class="form-control" accept="image/*">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Details Image</label>
            <?php if (isset($current_images[2])): ?>
                <img src="<?= htmlspecialchars($current_images[2]['image_path']) ?>" 
                     class="img-thumbnail mb-2" style="max-width: 150px">
            <?php endif; ?>
            <input type="file" name="details_image" class="form-control" accept="image/*">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Extra Image</label>
            <?php if (isset($current_images[3])): ?>
                <img src="<?= htmlspecialchars($current_images[3]['image_path']) ?>" 
                     class="img-thumbnail mb-2" style="max-width: 150px">
            <?php endif; ?>
            <input type="file" name="extra_image" class="form-control" accept="image/*">
        </div>
    </div>

    <button type="submit" name="update_images" class="btn btn-primary">
        Update Images
    </button>
</form>
