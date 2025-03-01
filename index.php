
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

<!-- Carousel -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner mt-5">
      <?php if (!empty($sliderImages)): ?>
          <?php foreach ($sliderImages as $index => $image): ?>
              <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo htmlspecialchars(trim($image['image_path'])); ?>" 
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
</div>





<?php include './footer.php'; ?>
<?php include './jslink.php' ?>  
</body>
</html>