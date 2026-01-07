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
    <div class="about-sectionn">
        <div class="about-headerr">
            <h1>About Samala</h1>
        </div>

        <div class="content-wrapperr">
            <div class="image-containerr">
                <img src="./assest/slider/aboutus.png" alt="Samala Products">
            </div>

            <div class="text-containerr">
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

    <div class="visionMission">
        <div class="header">
            <h1>India's Trusted Choice for Household Hygiene & Safety</h1>
            <div class="tabs">
                <button class="tab-button active" onclick="showTab('tab1')">What We Do</button>
                <button class="tab-button" onclick="showTab('tab2')">Where We're Headed</button>
                <button class="tab-button" onclick="showTab('tab3')">What We Stand For</button>
            </div>
        </div>

        <div class="content-section">
            <!-- Tab 1: What We Do -->
            <div id="tab1" class="tab-content active">
                <div class="image-side">
                    <img src="./assest/m1.png" alt="What We Do">
                </div>
                <div class="text-side">
                    <h2>What We Do</h2>
                    <p>We specialize in developing and manufacturing innovative cleaning and care products using natural
                        chemicals and special clay minerals. Our research-driven approach ensures that every product
                        meets the highest standards of effectiveness and environmental responsibility.</p>
                    <p>From home care essentials to personal care products, we are committed to bringing safe,
                        effective, and eco-friendly solutions to every household across India.</p>
                </div>
            </div>

            <!-- Tab 2: Where We're Headed -->
            <div id="tab2" class="tab-content">
                <div class="image-side">
                    <img src="./assest/m2.png" alt="Where We're Headed">
                </div>
                <div class="text-side">
                    <h2>Where We're Headed</h2>
                    <p>Our vision is to become India's leading household hygiene brand, expanding our reach to every
                        corner of the country. We are continuously investing in research and development to innovate new
                        products that meet evolving consumer needs.</p>
                    <p>We aim to establish ourselves as a trusted name in sustainable household care, with plans to
                        expand internationally and bring our eco-friendly solutions to global markets while maintaining
                        our commitment to quality and safety.</p>
                </div>
            </div>

            <!-- Tab 3: What We Stand For -->
            <div id="tab3" class="tab-content">
                <div class="image-side">
                    <img src="./assest/m3.png" alt="What We Stand For">
                </div>
                <div class="text-side">
                    <h2>What We Stand For</h2>
                    <p>We stand for integrity, quality, and environmental responsibility. Our core values drive every
                        decision we make, from sourcing natural ingredients to ensuring safe manufacturing processes
                        that protect both people and the planet.</p>
                    <p>We believe in transparency with our customers, honesty in our business practices, and a
                        commitment to making products that are not only effective but also safe for families and the
                        environment. Customer trust is our greatest asset, and we work every day to maintain it.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- our founder -->
    <div class="founder-section">
        <div class="founder-header">
            <h1>Our Founder</h1>
        </div>

        <div class="founder-content">
            <div class="image-container">
                <img src="./assest/samalaFounder.png" alt="Founder" loading="lazy">
            </div>

            <div class="text-container">
                <p class="quote">
                    With over 20 years in the chemical industry, I founded Samala with a simple yet powerful vision: to
                    create products that are as gentle on the environment as they are effective for consumers. Our
                    journey began with a commitment to harness nature's power through innovative chemistry.
                </p>
                <p class="quote">
                    Every product we develop reflects our dedication to sustainability, health, and excellence. We're
                    not just creating cleaning products; we're building a legacy for future generations.
                </p>
            </div>
        </div>
    </div>
    <!-- certficate section -->
    <div class="compliance-section">
        <div class="compliance-header">
            <h1>Compliance & Certifications</h1>
        </div>

        <div class="certifications-container">
            <div class="logos-wrapper">
                <img src="./assest/samalaabout.png" alt="Compliance & Certifications Logos" loading="lazy">
            </div>
        </div>
    </div>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1500, // Animation duration in milliseconds
            once: true // Animation happens only once
        });
    </script>
    <script>
        function showTab(tabId) {
            // Hide all tab contents
            const allTabs = document.querySelectorAll('.tab-content');
            allTabs.forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all buttons
            const allButtons = document.querySelectorAll('.tab-button');
            allButtons.forEach(button => {
                button.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabId).classList.add('active');

            // Add active class to clicked button
            event.target.classList.add('active');
        }

    </script>
    <?php include './footer.php' ?>
    <?php include './jslink.php' ?>
</body>

</html>