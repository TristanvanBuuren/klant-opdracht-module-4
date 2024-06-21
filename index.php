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





<!-- -- -->
<div class="introductie">
        <img class="hoofd-foto" src="assets/img/henrik.png">
        <div class="hoofd-text">Hallo, ik ben Henrik Hogendijk en dit is wat ik doe en kan:<br><br>Ik doe tuinen maken en zin vol met passie blah blah</div>
    </div>
</main>
<script src="<?= BASEURL; ?>assets/js/slideshow.js"></script>


<?php
include ('assets/core/footer.php');
?>