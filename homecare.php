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
    <title>Samala Udyog - Home Care Products</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <?php include './header.php' ?>

    <section class="hero-section">
        <img src="./assest/slider/aboutBanner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>
    <div class="Homecontainer">
        <h1 class="homeh1">Home Care Products</h1>

        <div class="product-grid">

            <div class="product-card">
                <img src="./assest/products/homecare/home1.png" alt="">
                <div class="product-name">Clothesline Fabric Detergent liquid</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home2.png" alt="">
                <div class="product-name">NavNatra Super Fresh detergent</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home3.png" alt="">
                <div class="product-name">Navjot glass cleaner liquid spray</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home4.png" alt="">
                <div class="product-name">Clothesline Fabric Detergent liquid</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home5.png" alt="">
                <div class="product-name">NavBhumy Citrus floor cleaner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home6.png" alt="">
                <div class="product-name">NavBhumy Rose floor cleaner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home7.png" alt="">
                <div class="product-name">NavBhumy Lavender floor cleaner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home8.png" alt="">
                <div class="product-name">NavPatra Mint dish cleaner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home9.png" alt="">
                <div class="product-name">NavPatra Mint dish cleaner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home10.png" alt="">
                <div class="product-name">Classic touch cleaners spray</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home11.png" alt="">
                <div class="product-name">Clotheline Fabric Conditioner</div>
            </div>

            <div class="product-card">
                <img src="./assest/products/homecare/home1.png" alt="">
                <div class="product-name">BOWLINE (Toilet & Tile Cleaner)</div>
            </div>

        </div>

        <a href="https://samalaudyog.in/categories/8" target="_blank" class="buy-btn">Buy Products Here</a>
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