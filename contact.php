<?php
include('assets/core/header.php');
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
            <label for="name">Naam:</label>
            <input type="text" id="name" name="naam" placeholder="Uw Naam" value="<?php echo isset($_POST['naam']) ? $_POST['naam'] : ''; ?>" required>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" placeholder="Uw E-mail" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>

            <label for="message">Uw Bericht:</label>
            <textarea id="message" name="bericht" placeholder="Voer uw vraag of bericht in" required><?php echo isset($_POST['bericht']) ? $_POST['bericht'] : ''; ?></textarea>

            <?php 
            $errors = array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tijd_gemaakt = date('Y-m-d H:i:s');
                $naam = isset($_POST['naam']) ? trim(stripslashes(htmlspecialchars($_POST['naam']))) : '';
                $email = isset($_POST['email']) ? trim(stripslashes(htmlspecialchars($_POST['email']))) : '';
                $bericht = isset($_POST['bericht']) ? trim(stripslashes(htmlspecialchars($_POST['bericht']))) : '';

                if (empty($naam)) {
                    $errors[] = "Naam is verplicht.";
                } elseif (!preg_match("/^[a-zA-Z ]*$/", $naam)) {
                    $errors[] = "Ongeldige naam. Gebruik alleen letters en spaties.";
                }

                if (empty($email)) {
                    $errors[] = "Email is verplicht.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Ongeldig email adres.";
                }

                if (empty($bericht)) {
                    $errors[] = "Bericht is verplicht.";
                }

                if (empty($errors)) {
                    $naam = mysqli_real_escape_string($con, $naam);
                    $email = mysqli_real_escape_string($con, $email);
                    $bericht = mysqli_real_escape_string($con, $bericht);

                    $sql = "INSERT INTO contact (naam, email, bericht, tijd_gemaakt) VALUES ('$naam', '$email', '$bericht', '$tijd_gemaakt')";

                    if ($con->query($sql) === TRUE) {
                        // Redirect naar de nieuwe pagina met de ingevulde gegevens
                        $_SESSION['naam'] = $naam;
                        $_SESSION['email'] = $email;
                        $_SESSION['bericht'] = $bericht;
                       
                        header("Location: verstuurt.php");
                        exit();
                    } else {
                        echo "Fout bij het opslaan van de gegevens: " . $con->error;
                    }
                }
            }
            if (!empty($errors)) { ?>
            <div class="error-messages">
                <?php foreach ($errors as $error) { ?>
                    <p><?php echo $error; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
            <button type="submit">Verstuur</button>
        </form>
        <div class="contact-info">
        <img src="assets/img/henrik.png" alt="Hendrik Hogendijk" width="150" height="100">
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
                        if ($info_prefix != 'mailto') {
                            echo $info_prefix . ": " . "<a href='" . $info_prefix . ":" . $info_tekst ."'>" . $info_tekst . "</a>" ."<br>";
                            }
                            if ($info_prefix == 'mailto') {
                                echo "e-mail". ": " . "<a href='" . $info_prefix . ":" . $info_tekst ."'>" . $info_tekst . "</a>" ."<br>";
                            }
                    }
                }
                $liqry->close();
            }
            ?>
         
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
  
           
        </div>
    </div>
</body>
</html>
<?php
include('assets/core/footer.php');
?>