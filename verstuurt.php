<?php
include('assets/core/header.php');

// Gegevens ophalen uit sessie
$naam = isset($_SESSION['naam']) ? $_SESSION['naam'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$bericht = isset($_SESSION['bericht']) ? $_SESSION['bericht'] : '';

// Sessiegegevens verwijderen
unset($_SESSION['naam']);
unset($_SESSION['email']);
unset($_SESSION['bericht']);
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neem Contact Op</title>
</head>
<body>
   
    <div class="container">
        
    <form action="" method="post">
    <h2>Bedankt voor uw bericht!</h2>
        <p>Hier zijn de gegevens die u heeft ingevuld:</p>
        <p><strong>Naam:</strong> <?php echo $naam; ?></p>
        <p><strong>E-mailadres:</strong> <?php echo $email; ?></p>
        <p><strong>Bericht:</strong><div class="text-wrap"><?php echo $bericht; ?></div> </p>
         
           
        </form>
        <div class="contact-info">
            <h2>Neem Contact Op</h2>
            <?php
        $sql = "SELECT info_prefix, info_tekst FROM informatie WHERE info_type = 1";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_prefix, $info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_prefix . ": " . "<a href='" . $info_prefix . ":" . $info_tekst ."'>" . $info_tekst . "</a>" ."<br>";
                }
            }
            $liqry->close();
        }
        ?>
      
            <div class="social-links">
                <a href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
            <p><b>Openingstijden:</b></p>
            <?php
        $sql = "SELECT info_prefix, info_tekst FROM informatie WHERE info_type = 2";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_prefix, $info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_prefix . " " . $info_tekst . "<br>";
                }
            }
            $liqry->close();
        }
        ?>
      
            <img src="assets/img/henrik.png" alt="Hendrik Hogendijk" width="150" height="100">
        </div>
    </div>
</body>
</html>
<?php
?>
<?php
include('assets/core/footer.php');
?>
