<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
 <link rel="stylesheet" teype="text/css"   href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <?php include './mainlink.php'  ?>
   <link rel="stylesheet" href="product.css">
  <?php include './mainlink.php'   ?>
  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <?php include './header.php' ?>
  <section class="about-banner">
    <div class="banner-content">
      <h1>Products</h1>
    </div>
  </section>
  <?php
include './admin/dbconfig.php';

// Fetch products along with their images
$sql = "
    SELECT 
        allproducts.*, 
        GROUP_CONCAT(product_images.image_path) AS product_images
    FROM 
        allproducts
    LEFT JOIN 
        product_images
    ON 
        allproducts.id = product_images.product_id
    GROUP BY 
        allproducts.id
";

$result = $conn->query($sql);
$categories = [];
while ($row = $result->fetch_assoc()) {
    // Decode the concatenated image paths into an array
    $imagePaths = $row['product_images'] ? explode(',', $row['product_images']) : [];
    
    // Clean up image paths by removing the ./ prefix
    $imagePaths = array_map(function($path) {
        return str_replace('./', '', $path);
    }, $imagePaths);

    // Use the first image in the array, if available
    $row['first_image'] = count($imagePaths) > 0 ? $imagePaths[0] : '';
    $row['product_images'] = json_encode($imagePaths); // Store cleaned image paths as JSON

    $categories[$row['subject']][] = $row;
}

$conn->close();
?>

<!-- Product Section -->
<div class="product-section">
    <?php foreach ($categories as $category => $products): ?>
        <div class="category">
            <h2><?php echo htmlspecialchars($category); ?></h2>
            <div class="product-cards">
                <?php foreach ($products as $product): ?>
                    <div class="product-card" data-aos="flip-left">
                        <img src="./admin/<?php echo htmlspecialchars($product['first_image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['title']); ?>" loading="lazy">
                        <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="price">&#8377; <?php echo htmlspecialchars($product['final_price']); ?></div>
                        <button class="buy-btn" 
                                data-title="<?php echo htmlspecialchars($product['title']); ?>"
                                data-price="<?php echo htmlspecialchars($product['final_price']); ?>"
                                data-description="<?php echo htmlspecialchars($product['description']); ?>"
                                data-flipkart-url="<?php echo htmlspecialchars($product['flipkart_url']); ?>"
                                data-amazon-url="<?php echo htmlspecialchars($product['amazon_url']); ?>"
                                data-jiomart-url="<?php echo htmlspecialchars($product['jiomart_url']); ?>"
                                data-images='<?php echo htmlspecialchars($product['product_images']); ?>'>
                            Buy
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Big Card -->
<div id="bigCard" class="big-card hidden">
    <div class="big-card-content">
        <button class="close-btn" onclick="hideBigCard()">×</button>
        <div class="big-card-header">
            <img id="bigCardImage" src="" alt="Product Image" class="big-card-image">
        </div>
        <div class="thumbnail-gallery">
        
            <div id="bigCardThumbnails" class="thumbnails"></div>
        </div>
        <h2 id="bigCardTitle"></h2>
        <div class="big-card-body">
            <div class="big-card-price">
                <span class="price-label">Price: </span>
                <span id="bigCardPrice"></span>
            </div>
            <div id="bigCardDescription"></div>
            
            <h4 class="find-product-title">Find our product here:</h4>
            <div class="product-links">
                <a id="amazonLink" href="#" target="_blank">
                    <img src="./assest/logo/shopping.png" alt="Amazon" class="product-logo">
                </a>
                <a id="flipkartLink" href="#" target="_blank">
                    <img src="./assest/logo/i1.png" alt="Flipkart" class="product-logo">
                </a>
                <a id="jiomartLink" href="#" target="_blank">
                    <img src="./assest/logo/JioMart_logo.svg.png" alt="JioMart" class="product-logo">
                </a>
            </div>
        </div>
    </div>
</div>


<script>
// Attach click event listeners to all elements with the 'buy-btn' class
document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', function() {
        const { title, price, description, flipkartUrl, amazonUrl, jiomartUrl, images } = this.dataset;

        let parsedImages;
        try {
            // Attempt to parse the images array from the data attribute
            parsedImages = JSON.parse(images);
        } catch (error) {
            parsedImages = [];
            console.error('Error parsing images:', error);
        }

        // Prepend '../admin/' to each image path if applicable
        const processedImages = parsedImages.map(img => `../admin/${img}`);

        // Call the function to display the big card with all the data
        showBigCard(title, processedImages, price, description, flipkartUrl, amazonUrl, jiomartUrl);
    });
});

// Function to hide the big card
function hideBigCard() {
    const bigCard = document.getElementById('bigCard');
    if (bigCard) {
        bigCard.classList.add('hidden');
    } else {
        console.warn('Big card element not found.');
    }
}

// Function to show the big card with detailed product information
function showBigCard(title, images, price, description, flipkartUrl, amazonUrl, jiomartUrl) {
    const bigCardTitle = document.getElementById('bigCardTitle');
    const bigCardImage = document.getElementById('bigCardImage');
    const bigCardPrice = document.getElementById('bigCardPrice');
    const bigCardDescription = document.getElementById('bigCardDescription');
    const thumbnailContainer = document.getElementById('bigCardThumbnails');
    const amazonLink = document.getElementById('amazonLink');
    const flipkartLink = document.getElementById('flipkartLink');
    const jiomartLink = document.getElementById('jiomartLink');

    // Update content dynamically
    if (bigCardTitle) bigCardTitle.textContent = title || 'No Title';
    if (bigCardImage) bigCardImage.src = images[0] || ''; // Display the first image
    if (bigCardPrice) bigCardPrice.textContent = price ? `₹ ${price}` : 'Price not available';
    if (bigCardDescription) {
        bigCardDescription.innerHTML = `<h4 class="description-title">Description:</h4><p>${description || 'No description available.'}</p>`;
    }

   // Update content dynamically
    if (bigCardTitle) bigCardTitle.textContent = title || 'No Title';
    if (bigCardImage) bigCardImage.src = images[0] || ''; // Display the first image
    if (bigCardPrice) bigCardPrice.textContent = price ? `₹ ${price}` : 'Price not available';
    if (bigCardDescription) {
        bigCardDescription.innerHTML = `<h4 class="description-title">Description:</h4><p>${description || 'No description available.'}</p>`;
    }

    // Display Amazon link/logo only if URL is provided
    if (amazonUrl) {
        amazonLink.href = amazonUrl;
        amazonLink.style.display = 'inline-block';
    } else {
        amazonLink.style.display = 'none';
    }

    // Display Flipkart link/logo only if URL is provided
    if (flipkartUrl) {
        flipkartLink.href = flipkartUrl;
        flipkartLink.style.display = 'inline-block';
    } else {
        flipkartLink.style.display = 'none';
    }

    // Display JioMart link/logo only if URL is provided
    if (jiomartUrl) {
        jiomartLink.href = jiomartUrl;
        jiomartLink.style.display = 'inline-block';
    } else {
        jiomartLink.style.display = 'none';
    }

    // Generate and append thumbnails
    if (thumbnailContainer) {
        thumbnailContainer.innerHTML = ''; // Clear any existing thumbnails
        images.forEach(image => {
            const imgElement = document.createElement('img');
            imgElement.src = image;
            imgElement.alt = title || 'Thumbnail';
            imgElement.classList.add('thumbnail');
            imgElement.addEventListener('click', () => {
                if (bigCardImage) bigCardImage.src = image;
            });
            thumbnailContainer.appendChild(imgElement);
        });
    } else {
        console.warn('Thumbnail container element not found.');
    }

    // Show the big card by removing the 'hidden' class
    const bigCard = document.getElementById('bigCard');
    if (bigCard) {
        bigCard.classList.remove('hidden');
    } else {
        console.warn('Big card element not found.');
    }
}
</script>

  <?php
  include 'footer.php'
  ?>
</body>
 <!-- AOS JS -->
 <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1500, // Animation duration in milliseconds
            once: true // Animation happens only once
        });
    </script>
</html>