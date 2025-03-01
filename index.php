
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samala Udyog</title>

     <!-- Css Link  -->
     <?php include './mainlink.php'  ?>
</head>
<body>
<?php include './header.php' ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./admin/dbconfig.php');

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch images
$query = "SELECT image_path FROM slider_images";
$result = $conn->query($query);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

// Fix: Use fetch_assoc() instead of fetch_all()
$sliderImages = [];
while ($row = $result->fetch_assoc()) {
    $sliderImages[] = $row;
}

$conn->close();
?>


  <!----product display--->






  <!-- Carousel slider -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner mt-5">
      <?php if (!empty($sliderImages)): ?>
          <?php foreach ($sliderImages as $index => $image): ?>
              <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                  <?php
                  // Adjust the path to reflect the correct relative directory
                  $fullPath = './admin/' . trim($image['image_path']);
                  ?>
                  <img src="<?php echo $fullPath; ?>" 
                       class="d-block w-100 img-fluid" 
                       alt="Slider Image" 
                       style="object-fit: cover; max-height: 400px;">
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="carousel-item active">
              <img src="path/to/default/image.jpg" 
                   class="d-block w-100 img-fluid" 
                   alt="Default Image" 
                   style="object-fit: cover; max-height: 400px;">
          </div>
      <?php endif; ?>
  </div>
</div>

 <!-- -----------------About -section     -->
   
 <section class="about-section mt-3">
        <div class="container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2" data-aos="fade-left">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">About </span>
                            <h2>Nature-Driven Innovation for a Better, Safer World</h2>
                        </div>
                        <div class="text">Samala Udyog is an innovation-driven start-up that is dedicated to providing innovative products made with natural chemicals and special clay minerals to customers who prioritize the environment and health. The company was founded by a duo with a combined 40 years of experience in the chemical industry and a passion for creating sustainable and effective products.</div>
                        <div class="text">
                            With a focus on natures’ bounty, we are committed to providing our customers with the best of natural ingredients for Home care, Personal care, and Industrial care applications. Join us in our mission to create a healthier and more sustainable world, one natural product at a time.
                        </div>
                        <div class="btn-box">
                            <a href="./contact.php" class="theme-btn btn-style-one">Contact Us</a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12" data-aos="fade-right">
                    <div class="inner-column wow fadeInLeft">
                        <div class="author-desc">
                            <h2></h2>
                            <span>Founder</span>
                        </div>
                        <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images"><img title="Rahul Kumar Yadav" src="https:./assest/Founder.png" alt=""></a></figure>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <?php
    // Include database configuration
    include './admin/dbconfig.php';

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

// Initialize arrays for categories
$categories = ['Home Care', 'Personal Care', 'Hospital Care', 'Speciality Chemicals'];

// Array to hold products by category
$productsByCategory = [];

// Function to fetch images related to a product
function getProductImages($productId, $conn)
{
    $images = [];
    $query = "SELECT image_path FROM product_images WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $images[] = "./admin/" . $row['image_path']; // Add the base path
    }

    return $images;
}

// Check if the connection was established
if (isset($conn)) {
    foreach ($categories as $category) {
        $query = "SELECT * FROM allproducts WHERE subject = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $category);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = $result->fetch_all(MYSQLI_ASSOC);

        // Fetch related images for each product
        foreach ($products as &$product) {
            $product['images'] = getProductImages($product['id'], $conn);
        }

        $productsByCategory[$category] = $products;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Database connection is not established.";
}

    // Function to render product section
    // Function to render product section
function renderProductSection($category, $products)
{
    ?>
    <section>
        <div class="container">
            <div class="sec-title">
                <h2><?php echo htmlspecialchars($category); ?></h2>
            </div>
            <div class="slick-slider">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="me-3">
                            <div class="box-img mb-3">
                                <!-- Display the first image if available -->
                                <?php if (!empty($product['images'])): ?>
                                    <img src="<?php echo htmlspecialchars($product['images'][0]); ?>"
                                        alt="<?php echo htmlspecialchars($product['title'] ?? ''); ?>"
                                        class="img-fluid"
                                        style="border-radius: 10px;">
                                <?php else: ?>
                                    <img src="./admin/default-image.png"
                                        alt="Default Image"
                                        class="img-fluid"
                                        style="border-radius: 10px;">
                                <?php endif; ?>
                            </div>
                            <div class="box-heading">
                                <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                                <p class="description"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                                <h5 class="mb-3">
                                    <s class="text-danger">Rs.<?php echo htmlspecialchars($product['final_price']); ?></s>
                                    <span>Rs.<?php echo htmlspecialchars($product['discounted_price']); ?></span>
                                </h5>
                                <button onclick="showProductModal(<?php echo htmlspecialchars(json_encode($product)); ?>)" class="btn bg-danger text-white w-100">Buy</button>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products available in this category.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}

// Render product sections
$categories = array_keys($productsByCategory);
foreach ($categories as $category) {
    renderProductSection($category, $productsByCategory[$category]);
}
    ?>




<?php include './footer.php'; ?>
<?php include './jslink.php' ?>  
</body>
</html>