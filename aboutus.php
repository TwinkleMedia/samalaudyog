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
    <title>About Us - Responsive Page</title>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .banner-content h1 {
            font-size: 3.8rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: #291385;
            margin: 0;
        }

        @media (max-width: 768px) {
            .about-banner {
                height: 40vh;
                background-position: top;
                /* Adjusts the image position on mobile */
                padding: 0 10px;
            }

            .banner-content h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .about-banner {
                height: 30vh;
                background-position: top;
                /* Ensures the important part of the image is visible */
                padding: 10px 20px;
                /* Adds some top and bottom padding to the banner */
            }

            .banner-content h1 {
                font-size: 1.8rem;
                line-height: 1.2;
                /* Adds better spacing between lines */
            }
        }

        /* Base Styles */
        .why-choose-us {
            background-color: white;
            /* Dark blue background */
            color: darkblue;
            /* White text */
            padding: 50px 5%;
            /* Reduced padding to use more space */
            text-align: center;
            width: 100%;
            /* Full width */
            box-sizing: border-box;
            /* Ensure padding is included in width calculation */
        }

        .why-choose-us h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Center the features */
            gap: 20px;
            max-width: 1200px;
            /* Optional: Restrict max width for better readability */
            margin: 0 auto;
            /* Center the feature container */
        }

        .feature {
            background-color: #2a4a7c;
            /* Slightly lighter dark blue for contrast */
            border-radius: 8px;
            padding: 20px;
            flex: 1 1 30%;
            /* Allow the feature boxes to grow/shrink */
            max-width: 30%;
            /* Keep them within 30% width */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .feature h3 {
            font-size: 1.5em;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .feature p {
            font-size: 1em;
            line-height: 1.6;
        }

        /* Hover Effects */
        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .feature {
                max-width: 45%;
                /* Adjust width for tablets */
            }
        }

        @media (max-width: 768px) {
            .features {
                flex-direction: column;
                align-items: center;
            }

            .feature {
                max-width: 80%;
                /* Adjust width for mobile devices */
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .why-choose-us h2 {
                font-size: 2em;
            }

            .feature {
                max-width: 100%;
                /* Full width for smaller screens */
            }
        }
    </style>
</head>

<body>
    <?php include './header.php' ?>

    <section class="hero-section">
        <img src="./assest/slider/aboutBanner.png" alt="Hero Banner" class="hero-img" loading="lazy">
    </section>
    <div class="container">
        <div class="about-us">
            <div class="about-image" data-aos="fade-left">
                <img style="width: 500px; height: 400px;" src="./assest/slider/ada.png" alt="About Us">
            </div>
            <div class="about-content" data-aos="fade-right">
                <h1>About Us</h1>
                <p>We are a leading company in our industry, committed to providing top-notch services to our clients.
                    Our team of experienced professionals is dedicated to delivering the highest quality of work,
                    ensuring customer satisfaction every step of the way.</p>
                <p>Founded on the principles of integrity and excellence, we strive to build lasting relationships with
                    our clients by understanding their unique needs and exceeding their expectations.</p>
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