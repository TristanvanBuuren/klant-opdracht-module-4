<?php
include ('assets/core/header.php');

$sql = "SELECT persoon, review FROM hoofdpagina LIMIT 6"; // Haal maximaal 6 reviews op
$result = $con->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
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
            <div class="review-name"></div>
            <div class="review-text"></div>
        </div>
    </div>

    <script>
        const reviews = <?php echo json_encode($reviews); ?>;
    </script>
</main>
<script src="<?= BASEURL; ?>assets/js/slideshow.js"></script>
<script src="<?= BASEURL; ?>assets/js/slideshow2.js"></script>


<?php
include ('assets/core/footer.php');
?>