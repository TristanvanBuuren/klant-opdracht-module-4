<?php
include ('assets/core/header.php');
?>
<main>
    <div class="slideshow">
        <?php
        for ($i = 1; $i <= 3; $i++) {
            $randomImage = 'tuin' . $i . '.png';
            ?>
            <div class="slide">
                <img src="assets/img/<?php echo $randomImage; ?>" alt="Random Image" <?php if ($i == 1)
                       echo 'class="active"'; ?>>
                <?php ?>
                <div class="slide-text">Welkom op de website van Hendrik Hogendijk</div>
                <?php ?>
            </div>
        <?php } ?>
    </div>
    <div class="reviews">
        <div class="review">
            <div class="review-name">John Doe</div>
            <div class="review-text">Very nice.</div>
        </div>
    </div>
</main>
<script src="<?= BASEURL; ?>assets/js/slideshow.js"></script>
<script src="<?= BASEURL; ?>assets/js/slideshow2.js"></script>


<?php
include ('assets/core/footer.php');
?>