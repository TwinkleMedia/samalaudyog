<?php
    // Include database configuration
    include('./admin/dbconfig.php'); // Adjust path as needed

    // Initialize the $sliderImages array
    $sliderImages = [];

    // Check if the connection was established
    if (isset($conn)) {
        // Fetch images from the database
        $query = "SELECT image_path FROM slider_images"; // Adjust the query based on your table structure
        $result = $conn->query($query);

        if ($result) {
            // Fetch all rows as associative array
            $sliderImages = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Error fetching slider images: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Database connection is not established.";
    }
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
                    $fullPath = '../admin/' . trim($image['image_path']);
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


<!--  -->


<?php
    // Include database configuration
include('./admin/dbconfig.php');

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
        $images[] = "../admin/" . $row['image_path']; // Add the base path
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
                                    <img src="../admin/default-image.png"
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

    <!-- Product Modal Structure -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fs-4 fw-bold" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row g-4">
                    <!-- Product Images Gallery -->
                    <div class="col-lg-6">
                        <div class="product-gallery">
                            <!-- Main Product Image Container -->
                            <div class="position-relative mb-3 main-image-container">
                                <img id="mainImage" src="" alt="Main Product Image" 
                                     class="img-fluid rounded shadow-sm w-100 object-fit-cover" 
                                     style="max-height: 400px;">
                            </div>
                            <!-- Thumbnails Gallery -->
                            <div class="thumbnails-container">
                                <div id="thumbnailGallery" 
                                     class="d-flex gap-2 overflow-x-auto py-2 thumbnail-wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Information -->
                    <div class="col-lg-6">
                        <div class="product-details">
                            <h3 class="product-title h4 mb-3 fw-bold" id="modalProductTitle"></h3>
                            
                            <div class="product-price mb-3 d-flex align-items-center">
                                <span class="h5 text-muted text-decoration-line-through me-3" id="originalPrice"></span>
                                <span class="h4 text-danger fw-bold" id="discountedPrice"></span>
                            </div>
                            
                            <div class="product-category mb-3 d-flex align-items-center">
                                <strong class="me-2">Category:</strong>
                                <span id="productCategory" class="badge bg-secondary"></span>
                            </div>
                            
                            <div class="product-description mb-4">
                                <h6 class="fw-bold mb-2">Product Description:</h6>
                                <p id="productDescription" class="text-muted"></p>
                            </div>
                            
                            
                            
                            <div class="ecommerce-links">
                                <h6 class="fw-bold mb-3">Buy from other platforms:</h6>
                                <div class="d-flex flex-wrap gap-3" id="ecommerceLinks"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>