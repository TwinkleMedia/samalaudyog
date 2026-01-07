<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" teype="text/css" href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <?php include './mainlink.php' ?>
    <title>Samala Udyog</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            flex-wrap: wrap;
        }

        .hero-text {
            flex: 1;
            min-width: 300px;
            text-align: left;
            color: white;
        }

        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .hero-text .product-name {
            font-size: 2rem;
            color: #ffd700;
            margin-bottom: 10px;
        }

        .hero-image {
            flex: 1;
            min-width: 300px;
            display: flex;
            justify-content: center;
        }

        .hero-image img {
            max-width: 400px;
            width: 100%;
            height: auto;
        }

        /* About Samala Section */
        .about-section {
            padding: 60px 20px;
            background: white;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .about-header h2 {
            font-size: 2.5rem;
            color: #291385;
            margin-bottom: 20px;
        }

        .about-content {
            display: flex;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
        }

        .about-products {
            flex: 1;
            min-width: 300px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .product-item {
            text-align: center;
        }

        .product-item img {
            width: 120px;
            height: 200px;
            object-fit: contain;
        }

        .about-text {
            flex: 1;
            min-width: 300px;
        }

        .about-text p {
            margin-bottom: 15px;
            text-align: justify;
            color: #555;
            line-height: 1.8;
        }

        /* Choice Section */
        .choice-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 20px;
            color: white;
        }

        .choice-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .choice-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .choice-header h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .choice-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .choice-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .choice-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
        }

        .choice-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .choice-card p {
            line-height: 1.6;
        }

        /* Founder Section */
        .founder-section {
            padding: 60px 20px;
            background: #f8f9fa;
        }

        .founder-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .founder-container h2 {
            font-size: 2.5rem;
            color: #291385;
            margin-bottom: 40px;
        }

        .founder-content {
            display: flex;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }

        .founder-image {
            flex: 0 0 300px;
        }

        .founder-image img {
            width: 250px;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .founder-text {
            flex: 1;
            min-width: 300px;
            text-align: left;
        }

        .founder-text p {
            margin-bottom: 15px;
            line-height: 1.8;
            color: #555;
        }

        /* Certifications Section */
        .certifications-section {
            padding: 60px 20px;
            background: white;
            text-align: center;
        }

        .certifications-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .certifications-container h2 {
            font-size: 2.5rem;
            color: #291385;
            margin-bottom: 40px;
        }

        .cert-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .cert-item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        /* Products CTA Section */
        .products-cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 20px;
            text-align: center;
            color: white;
        }

        .products-cta h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .products-showcase {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .product-showcase-item img {
            width: 100px;
            height: 160px;
            object-fit: contain;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 40px;
            background: #ffd700;
            color: #291385;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 30px;
            transition: transform 0.3s ease;
        }

        .cta-button:hover {
            transform: scale(1.05);
            background: #ffed4e;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text .product-name {
                font-size: 1.5rem;
            }

            .about-header h2,
            .choice-header h2,
            .founder-container h2,
            .certifications-container h2,
            .products-cta h2 {
                font-size: 2rem;
            }

            .hero-content,
            .about-content,
            .founder-content {
                flex-direction: column;
            }

            .choice-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
        <?php include './header.php' ?>

    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1>Samala's</h1>
                <div class="product-name">NavPatra</div>
                <div class="product-name">Dish Cleaner</div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <img src="./assest/slider/aboutBanner.png" alt="NavPatra Dish Cleaner">
            </div>
        </div>
    </section>

    <!-- About Samala Section -->
    <section class="about-section">
        <div class="about-container">
            <div class="about-header" data-aos="fade-up">
                <h2>About Samala</h2>
            </div>
            <div class="about-content">
                <div class="about-products" data-aos="fade-right">
                    <div class="product-item">
                        <img src="./assest/slider/aboutBanner.png" alt="Product 1">
                    </div>
                    <div class="product-item">
                        <img src="./assest/slider/aboutBanner.png" alt="Product 2">
                    </div>
                    <div class="product-item">
                        <img src="./assest/slider/aboutBanner.png" alt="Product 3">
                    </div>
                </div>
                <div class="about-text" data-aos="fade-left">
                    <p>Samala Udyog started with a mission to promote sustainable and eco-friendly cleaning solutions.
                        In an era where health and environmental consciousness is paramount, we introduce our flagship
                        product NavPatra - a dish cleaner made from natural ingredients.</p>
                    <p>Founded on the principles of purity and traditional wisdom, we believe that effective cleaning
                        doesn't have to compromise on safety or environmental health. Our products are crafted keeping
                        in mind the well-being of your family and our planet.</p>
                    <p>With years of experience in the chemical industry and a deep understanding of natural
                        formulations, we've developed products that are not only economical and effective but also
                        sustainable and safe for everyday use.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Choice Section -->
    <section class="choice-section">
        <div class="choice-container">
            <div class="choice-header" data-aos="fade-up">
                <h2>India's Trusted Choice for Household Hygiene or Safety</h2>
            </div>
            <div class="choice-grid">
                <div class="choice-card" data-aos="flip-up" data-aos-delay="100">
                    <h3>Why Go Natural?</h3>
                    <p>We specialize in developing eco-friendly and economical cleaning solutions. Our commitment to
                        health and safety drives us to create products that are free from harmful chemicals, ensuring a
                        safe environment for your family.</p>
                </div>
                <div class="choice-card" data-aos="flip-up" data-aos-delay="200">
                    <h3>Our Products</h3>
                    <p>Our NavPatra dish cleaner utilizes the natural cleaning power of plant-based ingredients. Gentle
                        on hands, tough on grease, and completely biodegradable - that's the Samala promise of quality
                        and sustainability.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Founder Section -->
    <section class="founder-section">
        <div class="founder-container">
            <h2 data-aos="fade-up">Our Founder</h2>
            <div class="founder-content">
                <div class="founder-image" data-aos="fade-right">
                    <img src="./assest/samalaFounder.png" alt="Founder">
                </div>
                <div class="founder-text" data-aos="fade-left">
                    <p>"It is my vision to the chemical industry which is driven by passion towards eco-friendly and
                        sustainable products made from natural sources of raw materials."</p>
                    <p>With decades of experience in product development and a deep commitment to sustainability, our
                        founder has led Samala Udyog to become a trusted name in eco-friendly household products.</p>
                    <p>Our journey started with a simple question - can we clean effectively without harming nature?
                        Today, we proudly answer with our products that reflect our dedication to health, safety, and
                        environmental responsibility.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="certifications-section">
        <div class="certifications-container">
            <h2 data-aos="fade-up">Compliance & Certifications</h2>
            <div class="cert-grid" data-aos="zoom-in">
                <div class="cert-item">
                    <img src="./assest/samalaabout.png" alt="ISO Certification">
                </div>
            </div>
        </div>
    </section>

    <!-- Products CTA Section -->
    <section class="products-cta">
        <div data-aos="fade-up">
            <h2>Check Out Our Products</h2>
            <p style="font-size: 1.2rem; margin-bottom: 30px;">We Care...you are Safe</p>
            <div class="products-showcase">
                <div class="product-showcase-item">
                    <img src="./assest/about3.png" alt="Product 1">
                </div>
            </div>
            <a href="#products" class="cta-button">Visit Our Products</a>
        </div>
    </section>

    <!-- AOS JS -->

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1500, // Animation duration in milliseconds
            once: true // Animation happens only once
        });
    </script>

    <?php include './footer.php' ?>
    <?php include './jslink.php' ?>
</body>

</html>