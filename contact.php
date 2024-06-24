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
            echo "Gegevens zijn succesvol verzonden!";
        } else {
            echo "Fout bij het opslaan van de gegevens: " . $con->error;
        }
    } else {
        // Echo de validatiefouten
        foreach ($errors as $error) {
            echo $error . "<br>";
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
            <!-- <p><b>TEL:</b> +31 6 12 34 56 78</p>
            <p><b>SMS:</b> 06 00 00 00 00</p>
            <p><b>E-mail:</b> hendrikhogend@klaopdracht.nl</p> -->
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
            <!-- <p>Maandag-Vrijdag: 7:00-17:00</p>
            <p>Zaterdag: Op afspraak</p>
            <p>Zondag: Gesloten</p> -->
            <img src="assets/img/henrik.png" alt="Hendrik Hogendijk" width="150" height="100">
        </div>
    </div>
</body>
</html>
<?php

// // Get the form fields and remove whitespace
// $name = strip_tags(trim($_POST["name"]));
// $name = str_replace(array("\r","\n"),array(" "," "),$name);
// $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
// $message = trim($_POST["message"]);

// // Check that data was submitted to the mailer
// if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     // Set a 400 (bad request) response code and exit
//     http_response_code(400);
//     echo "Er is iets fout gegaan. Controleer uw invulvelden en probeer het opnieuw.";
//     exit;
// }

// // Set the recipient email address
// $recipient = "hendrikhogend@klaopdracht.nl";

// // Set the email subject
// $subject = "Contactformulier van $name";

// // Build the email message
// $message = "Naam: $name\n";
// $message .= "E-mailadres: $email\n";
// $message .= "Bericht: $message";

// // Send the email
// if (mail($recipient, $subject, $message)) {
//     // Set a 200 (ok) response code and exit
//     http_response_code(200);
//     echo "Bedankt voor uw bericht! Wij zullen zo snel mogelijk reageren.";
//     exit;
// } else {
//     // Set a 500 (internal server error) response code and exit
//     http_response_code(500);
//     echo "Er is iets fout gegaan. Onze excuses voor het ongemak.";
//     exit;
// }

// ?>
<?php
include('assets/core/footer.php');
?>
