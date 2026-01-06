<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samala Udyog</title>

    <!-- Css Link  -->
    <?php include './mainlink.php' ?>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPMJZ86J" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


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


    <!-- Carousel slider -->
    <section class="hero-section">
        <img src="./assest/slider/banner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>

    <!-- About Section -->
    <section class="about-container">
        <div class="container">
            <div class="about-box">
                <p class="about-header">About Us</p>
                <h2 class="about-title">Nature-Driven Innovation for a Better, Safer World</h2>
                <p class="about-text">
                    Samala Udyog is an innovation-driven start-up that is dedicated to providing innovative products
                    made with natural chemicals and special clay minerals to customers who prioritize the environment
                    and health. The company was founded by a duo with a combined 40 years of experience in the chemical
                    industry and a passion for creating sustainable and effective products.
                </p>
                <p class="about-text">
                    With a focus on natures' bounty, we are committed to providing our customers with the best of
                    natural ingredients for Home care, Personal care, and Industrial care applications. Join us in our
                    mission to create a healthier and more sustainable world, one natural product at a time.
                </p>
                <div class="about-actions">
                    <a href="#contact" class="contact-btnn">Contact</a>
                </div>
            </div>
        </div>
    </section>

    <!-- -----------------Explore Product ----------------- -->

    <section class="container">
        <!-- Explore Product Categories Section -->
        <h2 class="section-title">Explore Product Categories</h2>

        <div class="products-grid">
            <div class="product-card">
                <img src="./assest/home.png" alt="Home Care Products" class="product-image" loading="lazy">
                <button class="checkout-btn">Checkout</button>
            </div>

            <div class="product-card">
                <img src="./assest/personal.png" alt="Personal Care Products" class="product-image" loading="lazy">
                <button class="checkout-btn">Checkout</button>
            </div>

            <div class="product-card">
                <img src="./assest/hospital.png" alt="Hospital Care Products" class="product-image" loading="lazy">
                <button class="checkout-btn">Checkout</button>
            </div>
        </div>
        </div>

        <!-- Why Choose Us Section -->
        <h2 class="why-title">Why Choose Us</h2>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="./assest/why1.png" alt="Industry experience" loading="lazy">
                </div>
                <h3 class="feature-title">Industry experience</h3>
                <p class="feature-text">Our industry experience ensures high-quality formulations, compliant production,
                    and products you can trust.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><img src="./assest/why2.png" alt="Industry experience" loading="lazy"></div>
                <h3 class="feature-title">High Production Standards</h3>
                <p class="feature-text">Built on strict quality control and high production standards.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="./assest/why3.png" alt="Customization & Private Label" loading="lazy">
                </div>
                <h3 class="feature-title">Customization & Private Label</h3>
                <p class="feature-text">Customized formulations and private labeling to match your business needs.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="./assest/why4.png" alt="Reliable Logistics Network" loading="lazy">
                </div>
                <h3 class="feature-title">Reliable Logistics Network</h3>
                <p class="feature-text">Our reliable logistics network ensures timely delivery and consistent supply
                    across regions.</p>
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
    $categories = ['Home Care', 'Personal Care', 'Hospital Care',];

    // Array to hold products by category
    $productsByCategory = [];

    // Function to fetch images related to a product
    function getProductImages($productId, $conn)
    {
        $images = [];
        $query = "SELECT image_path FROM product_images WHERE product_id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            return $images; // Return empty if the statement fails
        }

        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($image_path);

        while ($stmt->fetch()) {
            $images[] = "./admin/" . $image_path; // Add the base path
        }

        $stmt->close();
        return $images;
    }

    // Check if the connection was established
    if (isset($conn)) {
        foreach ($categories as $category) {
            $query = "SELECT id, title, description, final_price, discounted_price FROM allproducts WHERE subject = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                continue; // Skip this category if statement fails
            }

            $stmt->bind_param('s', $category);
            $stmt->execute();
            $stmt->store_result();

            $products = [];
            $stmt->bind_result($id, $title, $description, $final_price, $discounted_price);

            // Fetch data
            while ($stmt->fetch()) {
                $products[] = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'final_price' => $final_price,
                    'discounted_price' => $discounted_price,
                    'images' => getProductImages($id, $conn), // Fetch product images
                ];
            }

            $productsByCategory[$category] = $products;
            $stmt->close();
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Database connection is not established.";
    }

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
                                            alt="<?php echo htmlspecialchars($product['title'] ?? ''); ?>" class="img-fluid"
                                            style="border-radius: 10px;" loading="lazy">
                                    <?php else: ?>
                                        <img src="./admin/default-image.png" alt="Default Image" class="img-fluid"
                                            style="border-radius: 10px;">
                                    <?php endif; ?>
                                </div>
                                <div class="box-heading">
                                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                                    <p class="description">
                                        <?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?>
                                    </p>
                                    <h5 class="mb-3">
                                        <s class="text-danger">Rs.<?php echo htmlspecialchars($product['final_price']); ?></s>
                                        <span>Rs.<?php echo htmlspecialchars($product['discounted_price']); ?></span>
                                    </h5>
                                    <button onclick="showProductModal(<?php echo htmlspecialchars(json_encode($product)); ?>)"
                                        class="btn bg-danger text-white w-100">Buy</button>
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
    foreach ($productsByCategory as $category => $products) {
        renderProductSection($category, $products);
    }
    ?>

    <!-- -----------------------------------Specialty chemical -->

    <section class="hero">
        <div class="container">
            <h2>Specialty Ingredients, Chemicals & Minerals</h2>
            <p>Product Portfolio for Home & Personal Care, Pharma & Industrial Care</p>
            <a href="./assest/SUPL portfolio Feb-2021 (2).pdf" class="btn-download" download>
                <i class="fas fa-download"></i> Download PDF
            </a>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-4">Our Product Categories</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow">
                    <h4>Home & Personal Care</h4>
                    <p>Discover high-quality ingredients for beauty, skincare, and cleaning products.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow">
                    <h4>Pharmaceuticals</h4>
                    <p>Reliable ingredients ensuring top-quality pharma solutions.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow">
                    <h4>Industrial Care</h4>
                    <p>Essential chemicals and minerals for industrial applications.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- -----------------------New section------------- -->
    <div class="container py-5">
        <h2 class="text-center mb-5">Bring Unique Products and Formulations to the Market</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <h5 class="section-heading">Precision Manufacturing</h5>
                    <p>Our cutting-edge manufacturing systems guarantee the utmost product quality.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h5 class="section-heading">Premium Global Sourcing</h5>
                    <p>Curated selection of over 3000 premium natural ingredients sourced globally.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5 class="section-heading">Prompt Fulfillment</h5>
                    <p>Timely delivery to meet your launch deadlines and prevent stock shortages.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="section-heading">Stability Assured</h5>
                    <p>Formulations rigorously tested for stability, ensuring optimal performance in any environment.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <h5 class="section-heading">Infuse To Innovate</h5>
                    <p>Utilize innovative raw materials to set your products apart in the market.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon-circle">
                        <i class="bi bi-file-earmark-check-fill"></i>
                    </div>
                    <h5 class="section-heading">Regulatory Compliance</h5>
                    <p>Facilities compliant with GMP, ISO, and FDA standards for top-tier end-products.</p>
                </div>
            </div>
        </div>
    </div>



    <!-- --------video------------------ -->
    <section id="video-section" class="my-5">
        <div class="container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Video 1 -->
                    <div class="swiper-slide">
                        <div class="video-container">
                            <video class="video-embed" controls playsinline muted>
                                <source src="./assest/video1.mp4" type="video/mp4" loading="lazy">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="swiper-slide">
                        <div class="video-container">
                            <video class="video-embed" controls playsinline muted>
                                <source src="./assest/video2.mp4" type="video/mp4" loading="lazy">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="swiper-slide">
                        <div class="video-container">
                            <video class="video-embed" controls playsinline muted>
                                <source src="./assest/video3.mp4" type="video/mp4" loading="lazy">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <!-- Video 4 -->


                    <!-- Video 5 -->

                </div>

                <!-- Swiper Controls -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>





    <!---------------------- video section end----------------------------- -->


    <!-- Product Modal Structure -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fs-4 fw-bold" id="productModalLabel">Product Details</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                    <span class="h5 text-muted text-decoration-line-through me-3"
                                        id="originalPrice"></span>
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

                                <div class="mb-4">
                                    <a href="https://wa.me/+919833535161" target="_blank"
                                        class="btn btn-success w-100">Bulk Order? Contact Us on WhatsApp</a>
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




    <!-- F -->

    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <div class="faq-question">What is Samala Udyog?</div>
            <div class="faq-answer">
                <p>Samala Udyog is an innovation-driven start-up that specializes in creating natural and sustainable
                    products for home care, personal care, and industrial care applications.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> Who founded Samala Udyog?</div>
            <div class="faq-answer">
                <p>Samala Udyog was founded by two passionate experts with a combined 40 years of experience in the
                    chemical industry.</p>
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
                <p>Yes, all our products are formulated using natural ingredients and are designed to prioritize
                    environmental sustainability and health.</p>
            </div>
        </div>


        <div class="faq">
            <div class="faq-question"> Do your products contain harmful chemicals?</div>
            <div class="faq-answer">
                <p>No, we ensure our products are free from harmful synthetic chemicals and rely on natural chemicals
                    and clay minerals to deliver safe and effective solutions.</p>
            </div>
        </div>


        <div class="faq">
            <div class="faq-question"> How does Samala Udyog ensure sustainability?</div>
            <div class="faq-answer">
                <p>Sustainability is at the heart of our operations. We source natural ingredients responsibly and use
                    innovative techniques to minimize environmental impact while maintaining high-quality standards.</p>
            </div>
        </div>


        <div class="faq">
            <div class="faq-question"> Do you use biodegradable packaging?</div>
            <div class="faq-answer">
                <p>Yes, we are committed to using biodegradable and recyclable packaging materials whenever possible.
                </p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> Where can I purchase your products?</div>
            <div class="faq-answer">
                <p>Our products are available through our website, authorized distributors, and select retail outlets.
                </p>
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
                <p>Yes, we have a customer-friendly return and replacement policy. Please review the terms and
                    conditions on our website or contact customer support for assistance.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> Are you open to collaborations or partnerships?</div>
            <div class="faq-answer">
                <p>Absolutely! We welcome collaborations with like-minded organizations or individuals who share our
                    vision for sustainability and innovation.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> Do you work with B2B clients?</div>
            <div class="faq-answer">
                <p>Yes, we work closely with B2B clients and provide customized solutions to meet their specific needs.
                </p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-question"> What makes Samala Udyog different from other brands?
            </div>
            <div class="faq-answer">
                <p>Our commitment to sustainability, natural ingredients, and innovative solutions sets us apart. We
                    focus on creating effective products while caring for the environment and customer health..</p>
            </div>
        </div>


        <!-- Add more FAQs as needed -->

    </div>

    <!---------------------------------------------------Testimonail page------------------------------------->
    <div class="testimonial-container">

        <div class="container">
            <h2 style="text-align: center; margin-bottom: 30px;">What Our Clients Say</h2>

            <!-- Slider Container -->
            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <p class="testimonial-content">"Best place to get so many products at very cost effective range.
                            Owner is very friendly & well spoken. One can visit get the products which are not so
                            available in market plus all are genuine. So the reason 5 star for sure. Place is easy to
                            find from gmap. Easy to drive & accessible from any major roads"</p>
                        <p class="testimonial-author">- Mayuresh Lotlikar</p>
                    </div>
                    <div class="swiper-slide">
                        <p class="testimonial-content">"Thanks Mr. Murali Samala for helping me to arrange samples for
                            my start up. Keep up the good work"</p>
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



    <?php include './footer.php'; ?>
    <?php include './jslink.php' ?>

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
                    url: product.flipkart_url, // Corrected
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
                if (platform.url && platform.url.trim() !== '') { // Check if URL exists
                    const link = document.createElement('a');
                    link.href = platform.url; // Corrected
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

    </script>



</body>

</html>