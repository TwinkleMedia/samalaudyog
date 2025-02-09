<?php  
  ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

?>
<?php  
// Include database configuration file
include './dbconfig.php'; // Adjust the path based on your folder structure

if (isset($_POST['submit'])) {
    include 'dbconfig.php'; // Database connection

    $title = $_POST['Tname'];
    $subject = $_POST['subject'];
    $discounted_price = $_POST['Dprice'];
    $final_price = $_POST['Pprice'];
    $description = $_POST['description'];
    $flipkart_url = $_POST['flipkart_url'];
    $amazon_url = $_POST['amazon_url'];
    $indiamart_url = $_POST['indiamart_url'];
    $jiomart_url = $_POST['jiomart_url'];
    $created_at = date('Y-m-d H:i:s');

    // Insert product details into the `allproducts` table
    $query = "INSERT INTO allproducts (title, subject, discounted_price, final_price, description, flipkart_url, amazon_url, indiamart_url, jiomart_url, created_at)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssssss",
        $title,
        $subject,
        $discounted_price,
        $final_price,
        $description,
        $flipkart_url,
        $amazon_url,
        $indiamart_url,
        $jiomart_url,
        $created_at
    );

    if ($stmt->execute()) {
        $product_id = $stmt->insert_id; // Get the last inserted product ID

        // Upload directory for product images
        $uploadDir = './allproductsimages/';
        $imageFields = ['front_image', 'back_image', 'details_image', 'extra_image'];

        // Save images in a separate table
        $imageQuery = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
        $imageStmt = $conn->prepare($imageQuery);

        foreach ($imageFields as $fieldName) {
            if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
                $imageName = basename($_FILES[$fieldName]['name']);
                $targetFilePath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFilePath)) {
                    $imageStmt->bind_param("is", $product_id, $targetFilePath);
                    $imageStmt->execute();
                }
            }
        }

        echo "<script>alert('Product uploaded successfully!');</script>";
        // Redirect to the same page with a success parameter
        header("Location: uploadfile.php?status=success");
        exit();
    } else {
        echo "<script>alert('Error uploading product!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<?php  
// Include database configuration file
include './dbconfig.php'; // Adjust the path based on your folder structure

if (isset($_POST['submit'])) {
    include 'dbconfig.php'; // Database connection

    $title = $_POST['Tname'];
    $subject = $_POST['subject'];
    $discounted_price = $_POST['Dprice'];
    $final_price = $_POST['Pprice'];
    $description = $_POST['description'];
    $flipkart_url = $_POST['flipkart_url'];
    $amazon_url = $_POST['amazon_url'];
    $indiamart_url = $_POST['indiamart_url'];
    $jiomart_url = $_POST['jiomart_url'];
    $created_at = date('Y-m-d H:i:s');

    // Insert product details into the `allproducts` table
    $query = "INSERT INTO allproducts (title, subject, discounted_price, final_price, description, flipkart_url, amazon_url, indiamart_url, jiomart_url, created_at)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssssss",
        $title,
        $subject,
        $discounted_price,
        $final_price,
        $description,
        $flipkart_url,
        $amazon_url,
        $indiamart_url,
        $jiomart_url,
        $created_at
    );

    if ($stmt->execute()) {
        $product_id = $stmt->insert_id; // Get the last inserted product ID

        // Upload directory for product images
        $uploadDir = './allproductsimages/';
        $imageFields = ['front_image', 'back_image', 'details_image', 'extra_image'];

        // Save images in a separate table
        $imageQuery = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
        $imageStmt = $conn->prepare($imageQuery);

        foreach ($imageFields as $fieldName) {
            if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
                $imageName = basename($_FILES[$fieldName]['name']);
                $targetFilePath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFilePath)) {
                    $imageStmt->bind_param("is", $product_id, $targetFilePath);
                    $imageStmt->execute();
                }
            }
        }

        echo "<script>alert('Product uploaded successfully!');</script>";
        // Redirect to the same page with a success parameter
        header("Location: uploadfile.php?status=success");
        exit();
    } else {
        echo "<script>alert('Error uploading product!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

