
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
<?php include './header.php';?>

<!-- Slider -->
<?php
include('./dbconfig.php'); // Include database configuration

// Enable error reporting (for debugging only, remove in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Initialize slider images array
$sliderImages = [];

// Check database connection
if (!isset($conn)) {
    die("Database connection failed.");
}

// Fetch images from the database
$query = "SELECT image_path FROM slider_images"; 
$result = $conn->query($query);

if ($result) {
    $sliderImages = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error fetching images: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!-- Bootstrap Carousel -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner mt-5">
      <?php if (!empty($sliderImages)): ?>
          <?php foreach ($sliderImages as $index => $image): ?>
              <?php 
              // Ensure correct image path
              $imagePath = trim($image['image_path']); 
              ?>
              <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                       class="d-block w-100 img-fluid" 
                       alt="Slider Image" 
                       loading="lazy"
                       style="object-fit: cover; max-height: 400px;">
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="carousel-item active">
              <img src="path/to/default/image.jpg" 
                   class="d-block w-100 img-fluid" 
                   alt="Default Image" 
                   loading="lazy"
                   style="object-fit: cover; max-height: 400px;">
          </div>
      <?php endif; ?>
  </div>

  <!-- Optional Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </button>
</div>




<?php include './footer.php'; ?>
<?php include './jslink.php' ?>  
</body>
</html>