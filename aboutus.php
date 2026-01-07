<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" teype="text/css" href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <link rel="stylesheet" teype="text/css" href="aboutus.css">
    <?php include './mainlink.php' ?>
    <title>About Us - Responsive Page</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <?php include './header.php' ?>

    <section class="hero-section">
        <img src="./assest/slider/aboutBanner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>
    <div class="about-section">
        <div class="about-header">
            <h1>About Samala</h1>
        </div>

        <div class="content-wrapper">
            <div class="image-container">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23e8e8e8' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial, sans-serif' font-size='18' fill='%23666'%3EProduct Image%3C/text%3E%3C/svg%3E"
                    alt="Samala Products">
            </div>

            <div class="text-container">
                <p>
                    We are a leading company in our industry, committed to providing top-notch services to our clients.
                    Our team of experienced professionals is dedicated to delivering the highest quality of work,
                    ensuring customer satisfaction every step of the way.
                </p>
                <p>
                    Founded on the principles of integrity and excellence, we strive to build lasting relationships with
                    our clients by understanding their unique needs and exceeding their expectations.
                </p>
            </div>
        </div>
    </div>

    <div class="why-choose-us">
        <h2>Why Choose Us</h2>
        <div class="features">
            <div class="feature" data-aos="flip-left">
                <h3>Our Expertise</h3>
                <p>With our vast experience in the chemical industry, we are able to develop very good sources of
                    products and ingredients which are manufactured locally at the same time are economical and
                    effective. We have collaborated with like minded manufacturers and entered into agreement for
                    sourcing eco-friendly products in all our customer segments. We are strong in Product
                    development, manufacturing, supply chain, sales and marketing and can provide support to our
                    customers on technical and commerical aspects.</p>
            </div>
            <div class="feature" data-aos="flip-left">
                <h3>Product Development</h3>
                <p>Our product development expertise can guide customers market and product development activities
                    with innovative solutions keeping in view product life cycle aspects.</p>
            </div>
            <div class="feature" data-aos="flip-left">
                <h3>Supply Chain</h3>
                <p>Our supply chain team is capable of not only delivering products as per customer needs with
                    desired quantity within agreed timelines but can also take care of sustainability practices in
                    packaging of our products.</p>
            </div>
        </div>
    </div>


    <!------------------------------------Our experience------------------------------------>

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