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
    <title>Samala Udyog - Hospital Care Products</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <?php include './header.php' ?>

    <section class="hero-section">
        <img src="./assest/slider/aboutBanner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>
    <div class="Homecontainer">
        <h1 class="homeh1">Hospital Care Products</h1>

        <div class="product-grid">

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital1.png" alt="">
                <div class="product-name">LisoFort 4</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital2.png" alt="">
                <div class="product-name">LisoFort 2</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital3.png" alt="">
                <div class="product-name">LisoFortQ-2125 RTU</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital4.png" alt="">
                <div class="product-name">LisoFort PVP I 7.5</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital5.png" alt="">
                <div class="product-name">LisoFort Q-Safe</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital6.png" alt="">
                <div class="product-name">LisoFort Alderex Rapid</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital7.png" alt="">
                <div class="product-name">LisoFort Eco clean</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital8.png" alt="">
                <div class="product-name">LisoFort Alde Q Extra</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/hospitalcare/hospital9.png" alt="">
                <div class="product-name">LisoFort Q-Enzyme</div>
            </div>

        </div>

        <a href="https://samalaudyog.in/categories/7" target="_blank" class="buy-btn">Buy Products Here</a>
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