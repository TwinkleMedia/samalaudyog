
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
include('./dbconfig.php'); // Include your database configuration

$query = "SELECT image_path FROM images"; // Fetch images from database
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $first = true; // To mark the first item as active
    while ($row = mysqli_fetch_assoc($result)) {
        $activeClass = $first ? 'active' : '';
        echo '<div class="carousel-item ' . $activeClass . '">';
        echo '<img src="' . $row['image_path'] . '" class="d-block w-100" alt="...">';
        echo '</div>';
        $first = false; // Mark first item processed
    }
    ?>
  </div>
</div>
<?php
} else {
    echo "<p>No images found</p>";
}
?>




<?php include './footer.php'; ?>
<?php include './jslink.php' ?>  
</body>
</html>