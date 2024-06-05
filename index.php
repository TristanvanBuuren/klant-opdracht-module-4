<!DOCTYPE html>
<html lang="en">
<?php
include ('assets/core/header.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slideshow Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="section">
            <h2>Hoofdpagina</h2>
            <p>Beschrijving</p>
            <div class="scroll-container">
                <!-- info content here -->
            </div>
        </div>
        <div class="section">
            <h2>Personalia</h2>
            <p>(info)</p>
        </div>
        <div class="section">
            <h2>Sterren</h2>
            <!-- star rating system here -->
        </div>
        <div class="section">
            <h2>Contact</h2>
            <!-- contact form or info here -->
        </div>
        <div class="section">
            <h2>Slideshow</h2>
            <div class="slideshow">
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    $randomImage = 'tuin' . $i . '.png';
                    ?>
                    <img src="assets/img/<?php echo $randomImage; ?>" alt="Random Image" <?php if ($i == 1) echo 'class="active"'; ?>>
                <?php } ?>
            </div>
        </div>
        <div class="section">
            <h2>Reviews</h2>
            <!-- reviews komen hier -->
        </div>
    </div>

    <!-- JS voor slideshow -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var slides = document.querySelectorAll('.slideshow img');
            var currentSlide = 0;
            var slideInterval = setInterval(nextSlide, 7000); // Switch slide every 7 seconds

            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }
        });
    </script>
</body>
</html>
<?php
include ('assets/core/footer.php');
?>