<?php
include ('assets/core/header.php');
?>
<main>
    <div class="container">
        <h1>Klanten Opdracht</h1>
        <p>hier onder komen projecten</p>
        <div class="image-placeholder">
            <?php
            $placeholders = ['placeholder1.jpg', 'placeholder2.jpg', 'placeholder3.jpg'];
            $randomIndex = array_rand($placeholders);
            $selectedPlaceholder = $placeholders[$randomIndex];
            ?>
            <img src="<?php echo $selectedPlaceholder; ?>" alt="Image Placeholder">
        </div>
    </div>
</main>
<?php
include ('assets/core/footer.php');
?>