<?php
include('login/core/headerlogin.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Variabelen voor de ingevoerde waarden
$naam = '';
$email = '';
$tel = '';
$adress = '';
$stad = '';
$postcode = '';
$gg = '';

if (isset($_POST["submit"])) {
    // Sanitize inputs
    $naam = test_input($_POST['naam']);
    $email = test_input($_POST['email']);
    $tel = test_input($_POST['tel']);
    $adress = test_input($_POST['adress']);
    $stad = test_input($_POST['stad']);
    $postcode = test_input($_POST['postcode']);
    $gg = test_input($_POST['gg']);

    // Validate inputs
    $errors = array();

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

    if (empty($tel)) {
        $errors[] = "Telefoonnummer is verplicht.";
    } elseif (!preg_match("/^[0-9]{10}$/", $tel)) {
        $errors[] = "Ongeldig telefoonnummer. Voer een geldig 10-cijferig telefoonnummer in.";
    }

    if (empty($adress)) {
        $errors[] = "Adres is verplicht.";
    }

    if (empty($stad)) {
        $errors[] = "Stad is verplicht.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $stad)) {
        $errors[] = "Ongeldige stad. Gebruik alleen letters en spaties.";
    }

    if (empty($postcode)) {
        $errors[] = "Postcode is verplicht.";
    } elseif (!preg_match("/^[0-9]{4}[a-zA-Z]{2}$/", $postcode)) {
        $errors[] = "Ongeldige postcode. Gebruik het formaat '1234AB'.";
    }

    if (empty($gg)) {
        $errors[] = "Vraag of opmerking is verplicht.";
    }

    if (empty($errors)) {
        // Voer hier de code uit om de gegevens op te slaan in de database
        echo "Gegevens zijn succesvol verzonden!";
    }
}
?>

<
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
        <form action="contact_form_handler.php" method="post">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" placeholder="Uw Naam" required>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" placeholder="Uw E-mail" required>

            <label for="message">Uw Bericht:</label>
            <textarea id="message" name="message" placeholder="Voer uw vraag of bericht in" required></textarea>

            <button type="submit">Verstuur</button>
        </form>
        <div class="contact-info">
            <h2>Neem Contact Op</h2>
            <p><b>TEL:</b> +31 6 12 34 56 78</p>
            <p><b>SMS:</b> 06 00 00 00 00</p>
            <p><b>E-mail:</b> hendrikhogend@klaopdracht.nl</p>
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
            <p>Maandag-Vrijdag: 7:00-17:00</p>
            <p>Zaterdag: Op afspraak</p>
            <p>Zondag: Gesloten</p>
            <img src="assets/img/klant.png" alt="Hendrik Hogendijk" width="150" height="100">
        </div>
    </div>
</body>
</html>
<?php

// Get the form fields and remove whitespace
$name = strip_tags(trim($_POST["name"]));
$name = str_replace(array("\r","\n"),array(" "," "),$name);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$message = trim($_POST["message"]);

// Check that data was submitted to the mailer
if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Set a 400 (bad request) response code and exit
    http_response_code(400);
    echo "Er is iets fout gegaan. Controleer uw invulvelden en probeer het opnieuw.";
    exit;
}

// Set the recipient email address
$recipient = "hendrikhogend@klaopdracht.nl";

// Set the email subject
$subject = "Contactformulier van $name";

// Build the email message
$message = "Naam: $name\n";
$message .= "E-mailadres: $email\n";
$message .= "Bericht: $message";

// Send the email
if (mail($recipient, $subject, $message)) {
    // Set a 200 (ok) response code and exit
    http_response_code(200);
    echo "Bedankt voor uw bericht! Wij zullen zo snel mogelijk reageren.";
    exit;
} else {
    // Set a 500 (internal server error) response code and exit
    http_response_code(500);
    echo "Er is iets fout gegaan. Onze excuses voor het ongemak.";
    exit;
}

?>
<?php
include('assets/core/footer.php');
?>
