<?php
include('assets/core/header.php');

$naam = isset($_POST['naam']) ? $_POST['naam'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$bericht = isset($_POST['bericht']) ? $_POST['bericht'] : '';
$errors = array();

// Sanitize inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $naam = test_input($_POST['naam']);
    $email = test_input($_POST['email']);
    $bericht = test_input($_POST['bericht']);

    // Validate inputs
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

        $sql = "INSERT INTO contact (naam, email, bericht) VALUES ('$naam', '$email', '$bericht')";

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
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neem Contact Op</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="assets/img/hark-removebg-preview.png" alt="Hendrik Hogendijk Logo" width="40" height="40">
            </div>
            <div>
                <h1>Hendrik Hogendijk Project</h1>
                <p>Uw Vertrouwde Partner voor Excellentie</p>
            </div>
        </div>
    </header>
    <div class="container">
        
    <form action="" method="post">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="naam" placeholder="Uw Naam" value="<?php echo $naam; ?>" required>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" placeholder="Uw E-mail" value="<?php echo $email; ?>" required>

            <label for="message">Uw Bericht:</label>
            <textarea id="message" name="bericht" placeholder="Voer uw vraag of bericht in" required><?php echo $bericht; ?></textarea>

            <?php if (!empty($errors)) { ?>
            <div class="error-messages">
                <?php foreach ($errors as $error) { ?>
                    <p><?php echo $error; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
            <button type="submit">Verstuur</button>
        </form>
        <div class="contact-info">
            <h2>Neem Contact Op</h2>
            <?php
        $sql = "SELECT info_tekst FROM informatie WHERE info_type = 1";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_tekst . "<br>";
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
        $sql = "SELECT info_tekst FROM informatie WHERE info_type = 2";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_tekst . "<br>";
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
