<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './mainlink.php'  ?>
    <title>Document</title>
</head>
<body>
<!-- <?php include './header.php';?> -->

<!-- ----------------------- -->
<?php
// Include database configuration
include('./admin/dbconfig.php'); 

$sliderImages = [];

// Fetch images from the database
$query = "SELECT image_path FROM slider_images"; 
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sliderImages[] = $row;
    }
} else {
    echo "Error fetching slider images: " . $conn->error;
}

// Close the database connection after use
$conn->close();
?>

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


<!-- Video Section--------------------- -->
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

<!-- -------------------Faq  -->
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


        
    </div>
    <!-- Add more FAQs as needed -->


<!-- -----------------Textimonial -->
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
<!-- -----Footer -->
<?php include './footer.php'; ?>
</body>
</html>