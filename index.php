<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" teype="text/css"   href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    
    <?php include './mainlink.php'  ?>

    <title>Samala Udyog </title>
    
    <style>

</style>

    <!-- AOS CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">-->
</head>


<body>
    <?php include './header.php';?>
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
 <!----product display--->

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



<!-- --------------------------video Section-------------------------------------  -->

<!-- --------video------------------ -->
    <section id="video-section" class="my-5">
      <div class="container">
        <div class="row">
          <!-- Video 1 -->
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_01.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>

          <!-- Video 2 -->
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_02.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>

          <!-- Video 3 -->
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_03.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
          
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_04.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
          
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_05.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
          
          <div class="col-12 col-md-6 col-lg-4 py-3">
            <div class="video-container">
              <video class="video-embed" controls playsinline muted>
                <source
                  src="./assest/SAMALA_06.mp4"
                  type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>
      </div>
    </section>





<!---------------------- video section end----------------------------- -->







    <!-- F -->

    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <div class="faq-question" >What is Samala Udyog?</div>
            <div class="faq-answer">
                <p>Samala Udyog is an innovation-driven start-up that specializes in creating natural and sustainable products for home care, personal care, and industrial care applications.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> Who founded Samala Udyog?</div>
            <div class="faq-answer">
                <p>Samala Udyog was founded by two passionate experts with a combined 40 years of experience in the chemical industry.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question">What types of products does Samala Udyog offer?</div>
            <div class="faq-answer">
                <p>We offer a wide range of products for:</p>
                <li><b>Home Care:</b> Cleaners, detergents, and other household solutions.</li>
                 <li><b>Personal Care:</b> Products designed for skincare and hygiene.</li>
                  <li><b>Industrial Care: </b>Specialty products for industrial applications.</li>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> Are your products eco-friendly?</div>
            <div class="faq-answer">
                <p>Yes, all our products are formulated using natural ingredients and are designed to prioritize environmental sustainability and health.</p>
            </div>
        </div>


<div class="faq">
            <div class="faq-question"> Do your products contain harmful chemicals?</div>
            <div class="faq-answer">
                <p>No, we ensure our products are free from harmful synthetic chemicals and rely on natural chemicals and clay minerals to deliver safe and effective solutions.</p>
            </div>
        </div>


<div class="faq">
            <div class="faq-question"> How does Samala Udyog ensure sustainability?</div>
            <div class="faq-answer">
                <p>Sustainability is at the heart of our operations. We source natural ingredients responsibly and use innovative techniques to minimize environmental impact while maintaining high-quality standards.</p>
            </div>
        </div>


<div class="faq">
            <div class="faq-question"> Do you use biodegradable packaging?</div>
            <div class="faq-answer">
                <p>Yes, we are committed to using biodegradable and recyclable packaging materials whenever possible.</p>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> Where can I purchase your products?</div>
            <div class="faq-answer">
                <p>Our products are available through our website, authorized distributors, and select retail outlets.</p>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> Do you offer bulk orders or wholesale options?</div>
            <div class="faq-answer">
                <p>Yes, we cater to bulk and wholesale orders. Please contact us for more details on pricing and supply.

</p>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> How can I contact Samala Udyog for inquiries?</div>
            <div class="faq-answer">
                <p>You can reach us via our email or customer service number listed on our website.</p>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> Do you offer refunds or replacements for your products?</div>
            <div class="faq-answer">
                <p>Yes, we have a customer-friendly return and replacement policy. Please review the terms and conditions on our website or contact customer support for assistance.</p>
            </div>
        </div>
        
        <div class="faq">
            <div class="faq-question"> Are you open to collaborations or partnerships?</div>
            <div class="faq-answer">
                <p>Absolutely! We welcome collaborations with like-minded organizations or individuals who share our vision for sustainability and innovation.</p>
            </div>
        </div>
        
         <div class="faq">
            <div class="faq-question">  Do you work with B2B clients?</div>
            <div class="faq-answer">
                <p>Yes, we work closely with B2B clients and provide customized solutions to meet their specific needs.</p>
            </div>
        </div>
        
         <div class="faq">
            <div class="faq-question"> What makes Samala Udyog different from other brands?
</div>
            <div class="faq-answer">
                <p>Our commitment to sustainability, natural ingredients, and innovative solutions sets us apart. We focus on creating effective products while caring for the environment and customer health..</p>
            </div>
        </div>


        <!-- Add more FAQs as needed -->

    </div>
    
    <!---------------------------------------------------Testimonail page------------------------------------->
    <div class="container">
    
    <div class="testimonial-container">
    <h2 style="text-align: center; margin-bottom: 30px;">What Our Clients Say</h2>

    <!-- Slider Container -->
    <div class="swiper testimonial-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <p class="testimonial-content">"Best place to get so many products at very cost effective range. Owner is very friendly & well spoken. One can visit get the products which are not so available in market plus all are genuine. So the reason 5 star for sure. Place is easy to find from gmap. Easy to drive & accessible from any major roads"</p>
          <p class="testimonial-author">- Mayuresh Lotlikar</p>
        </div>
        <div class="swiper-slide">
          <p class="testimonial-content">"Thanks Mr. Murali Samala for helping me to arrange samples for my start up. Keep up the good work"</p>
          <p class="testimonial-author">- Pravin Mhaske</p>
        </div>
       
      </div>

      <!-- Pagination and Navigation -->
      <div class="swiper-pagination"></div>
      <!--<div class="swiper-button-next"></div>-->
      <!--<div class="swiper-button-prev"></div>-->
    </div>
  </div>
  
</div>

   
   
    
    <!--Footer-->
    
    <?php include './footer.php'; ?>

  
    <?php include './jslink.php' ?>
    
    
  
    
    
    
    
    
</body>

 <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <script>
   document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.testimonial-slider', {
        slidesPerView: 1,  // Force single slide view
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        // Disable any breakpoints to ensure only one slide shows
        breakpoints: {}
    });
});
  </script>







    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1500, 
            once: true 
        });
    </script>
    <!-- JavaScript for Modal Functionality -->
<script>
    function showProductModal(product) {
    // Set modal content
    document.getElementById('modalProductTitle').innerText = product.title || 'Product Title';
    document.getElementById('productDescription').innerText = product.description || 'No description available.';
    document.getElementById('originalPrice').innerText = product.final_price ? `Rs. ${product.final_price}` : '';
    document.getElementById('discountedPrice').innerText = product.discounted_price ? `Rs. ${product.discounted_price}` : '';
    document.getElementById('productCategory').innerText = product.subject || 'Unknown Category';

    // Handle images (existing code)
    const mainImage = document.getElementById('mainImage');
    const thumbnailGallery = document.getElementById('thumbnailGallery');
    thumbnailGallery.innerHTML = '';

    if (product.images && product.images.length > 0) {
        mainImage.src = product.images[0];
        mainImage.alt = product.title || 'Product Image';

        product.images.forEach(imagePath => {
            const thumbnail = document.createElement('img');
            thumbnail.src = imagePath;
            thumbnail.alt = product.title || 'Thumbnail';
            thumbnail.classList.add('img-thumbnail', 'rounded', 'me-2');
            thumbnail.style.cursor = 'pointer';
            thumbnail.addEventListener('click', () => {
                mainImage.src = imagePath;
            });
            thumbnailGallery.appendChild(thumbnail);
        });
    } else {
        mainImage.src = '../admin/default-image.png';
        mainImage.alt = 'Default Product Image';
    }

    // Handle e-commerce links
    const ecommerceLinks = document.getElementById('ecommerceLinks');
    ecommerceLinks.innerHTML = ''; // Clear existing links

    // Define e-commerce platforms with their icons and URLs from the product
    const platforms = [
        {
            name: 'Flipkart',
            icon: 'bi-cart-fill',
            url: product.flipkart_url,
            color: '#2874f0'
        },
        {
            name: 'Amazon',
            icon: 'bi-amazon',
            url: product.amazon_url,
            color: '#ff9900'
        },
        {
            name: 'IndiaMART',
            icon: 'bi-shop',
            url: product.indiamart_url,
            color: '#2e3192'
        },
        {
            name: 'JioMart',
            icon: 'bi-bag-fill',
            url: product.jiomart_url,
            color: '#0f4a8a'
        }
    ];

    // Create and append platform links
    platforms.forEach(platform => {
        if (platform.url) {
            const link = document.createElement('a');
            link.href = platform.url;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            link.classList.add('btn', 'btn-light', 'border', 'd-inline-flex', 'align-items-center', 'gap-2');
            link.style.color = platform.color;
            
            link.innerHTML = `
                <i class="bi ${platform.icon}"></i>
                <span>${platform.name}</span>
            `;
            
            ecommerceLinks.appendChild(link);
        }
    });

    // Show the modal
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    productModal.show();
}
</script>
</html>
