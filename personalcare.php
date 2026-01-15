<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" teype="text/css" href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <link rel="stylesheet" teype="text/css" href="aboutus.css">
    <?php include './mainlink.php' ?>
    <title>Samala Udyog - Personal Care Products</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <?php include './header.php' ?>

    <section class="hero-section">
        <img src="./assest/slider/aboutBanner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>
    <div class="Homecontainer">
        <h1 class="homeh1">Personal Care Products</h1>

        <div class="product-grid">

            <div class="product-card">
                <img src="./assest/products/personalcare/personal1.png" alt="">
                <div class="product-name">Bodyline Sandal Deodorant talc</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal2.png" alt="">
                <div class="product-name">Bodyline Icy Cool Deodorant talc</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal3.png" alt="">
                <div class="product-name">Bodyline Shower gel</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal4.png" alt="">
                <div class="product-name">HAIRLINE APPLE SHAMPOO</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal5.png" alt="">
                <div class="product-name">HAIRLINE SHIKAKAI SHAMPOO</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal6.png" alt="">
                <div class="product-name">HAIRLINE MILK SHAMPOO</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal7.png" alt="">
                <div class="product-name">Bodyline Face Wash</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal8.png" alt="">
                <div class="product-name">Hairline Hair Oil</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/personalcare/personal9.png" alt="">
                <div class="product-name">G-1 Hand & Feet Wash with AV</div>
            </div>

        </div>

        <a href="https://samalaudyog.in/categories/6" target="_blank" class="buy-btn">Buy Products Here</a>
    </div>
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