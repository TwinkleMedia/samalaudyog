<?php
include '../admin/dbconfig.php';

$sql = "SELECT title, image, subject FROM productpage";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Samala</title>
    <link rel="stylesheet" href="./style.css/mainstyle.css">
    <?php include './mainlink.php' ?>
      <!-- AOS CSS -->
      <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Your existing styles here */
        body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
  }

  .about-banner {
    background-image: url('./assest/slider/samala\ \ july-11\ \(1\).png');
    /* Replace with your image */
    background-size: cover;
    background-position: center;
    height: 65vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    text-align: center;
    color: white;
  }

  .banner-content h1 {
    font-size: 3.8rem;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    color: #291385;
  }

  @media (max-width: 768px) {
    .about-banner {
      height: 40vh;
    }

    .banner-content h1 {
      font-size: 2rem;
    }
  }

  @media (max-width: 480px) {
    .about-banner {
      height: 30vh;
    }

    .banner-content h1 {
      font-size: 1.5rem;
    }
  }

  .banner-content h1 {
    font-size: 3.8rem;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    color: darkblue;
  }

  @media (max-width: 768px) {
    .about-banner {
      height: 40vh;
    }

    .banner-content h1 {
      font-size: 2rem;
    }
  }

  @media (max-width: 480px) {
    .about-banner {
      height: 30vh;
    }

    .banner-content h1 {
      font-size: 1.5rem;
    }
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

/* Gallery Section Styles */
.gallery-section {
    background-color: #f0f8ff; /* Light blue background */
    padding: 2rem 0;
    transition: background-color 0.3s ease;
}

/* Dark mode styles */
@media (prefers-color-scheme: dark) {
    .gallery-section {
        background-color: #1a2639; /* Dark blue background */
        color: #ffffff;
    }
}

.gallery-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
}

.gallery-buttons button {
    background-color: #003366; /* Dark blue */
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-buttons button:hover {
    background-color: #004080;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
    padding: 0 2rem;
}

.gallery-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.gallery-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-card-title {
    padding: 1rem;
    text-align: center;
    background: rgba(0, 51, 102, 0.9); /* Dark blue with opacity */
    color: white;
    font-size: 1.1rem;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        padding: 0 1rem;
    }

    .gallery-buttons {
        flex-direction: column;
        align-items: center;
    }

    .gallery-buttons button {
        width: 80%;
        margin-bottom: 0.5rem;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.gallery-card {
    animation: fadeIn 0.5s ease-out forwards;
    opacity: 0;
}

.gallery-card:nth-child(1) { animation-delay: 0.1s; }
.gallery-card:nth-child(2) { animation-delay: 0.2s; }
.gallery-card:nth-child(3) { animation-delay: 0.3s; }
.gallery-card:nth-child(4) { animation-delay: 0.4s; }
/* Add more if needed */

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .gallery-card, .gallery-card img {
        transition: none;
        animation: none;
    }
}
    </style>
</head>
<body>
    <?php include 'header.php' ?>
    
    <section class="about-banner">
        <div class="banner-content">
            <h1>Gallery</h1>
        </div>
    </section>
      
    <section class="gallery-section">
        <div class="gallery-buttons">
            <button onclick="filterGallery('all')">All</button>
            <button onclick="filterGallery('Dish Wash Gel')">Dish Wash Gel</button>
            <button onclick="filterGallery('Laundry Detergent')">Laundry Detergent</button>
            <button onclick="filterGallery('Floor Cleaner')">Floor Cleaner</button>
            <button onclick="filterGallery('Glass Cleaner')">Glass Cleaner</button>
        </div>

        <div class="gallery-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = "../admin/productimage/" . htmlspecialchars($row['image']);
                    $category = htmlspecialchars($row['subject']);
                    ?>
                    <div class="gallery-card" data-aos="fade-left" data-category="<?php echo $category; ?>">
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <div class="gallery-card-title"><?php echo htmlspecialchars($row['title']); ?></div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </section>
    <script>
        function filterGallery(category) {
            var cards = document.querySelectorAll('.gallery-card');
            cards.forEach(function(card) {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    <?php include 'footer.php' ?>
       <!-- AOS JS -->
       <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1500, // Animation duration in milliseconds
            once: true // Animation happens only once
        });
    </script>
</body>
</html>