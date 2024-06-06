<?php
include ('assets/core/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Klanten Opdracht module-4.1</title>
</head>
<link rel="stylesheet" href="assets/css/style.css">
<body>
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
</body>
</html>
