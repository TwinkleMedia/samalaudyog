<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" teype="text/css"   href="hmainstyle.css">
    <link rel="stylesheet" teype="text/css" href="new.css">
    <link rel="stylesheet" teype="text/css" href="footer.css">
    <link rel="stylesheet" teype="text/css" href="sliderc.css">
    <?php include './mainlink.php'  ?>
    <title>Contact Us</title>
     <!-- AOS CSS -->
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
       

       
        
    </style>
</head>
<body>
<?php  include './header.php' ?>

<div class="container" style="margin-top: 100px;">
        <div class="contact-container">
            <div class="contact-form" data-aos="fade-left">
                <h2>Contact Us</h2>
                <form action="#" method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required></textarea>

                    <button type="submit" id="submitBtn">Send Message</button>
                </form>
            </div>

            <div class="map-container"data-aos="fade-right">
                <h2>Our Location</h2>
                <!-- Google Maps Embed -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15083.1684501051!2d73.0200499!3d19.0728757!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c165f961bbfd%3A0xb2708c896b592ef7!2sSamala%20Udyog%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1726209200695!5m2!1sen!2sin" 
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
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
    <?php include './footer.php' ?>
<?php include './jslink.php'?>
</body>
</html>
