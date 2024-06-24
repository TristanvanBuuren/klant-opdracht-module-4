<?php
include('login/core/headerlogin.php');
d
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

<main class="a">
    <div class="text-contact">We streven ernaar om constant in contact te staan met onze klanten totdat de klus geklaard
        is. Als u vragen of
        speciale verzoeken heeft, stuur ons dan een bericht. Voor een vrijblijvende offerte kunt u contact met ons
        opnemen
        wanneer het u uitkomt. Wij zijn u graag van dienst!
    </div>
    <div class="b">
        <form action="contact.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Uw naam</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe" name="naam" value="<?php echo $naam; ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="email" class="form-control" placeholder="name@example.com" aria-label="Email"
                    aria-describedby="basic-addon1" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+31</span>
                <input type="number" class="form-control" placeholder="0 6 00 00 00 00" aria-label="tel"
                    aria-describedby="basic-addon1" id="telefoon" name="tel" value="<?php echo $tel; ?>">
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adress" value="<?php echo $adress; ?>">
            </div>

            <div class="col-md-6">
                <label for="inputCity" class="form-label">stad</label>
                <input type="text" class="form-control" id="inputCity" name="stad" value="<?php echo $stad; ?>">
            </div>

            <div class="col-md-2">
                <label for="inputZip" class="form-label">postcode</label>
                <input type="text" class="form-control" id="inputZip" name="postcode" value="<?php echo $postcode; ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Vraag of opmerking</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gg"><?php echo $gg; ?></textarea>
            </div>

            <input class="btn btn-primary" type="submit" name="submit" value="Versturen">
        </form>

        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
        ?>
    </div>

    <div class="c">
        <div class="tel-nummer">
            <div class="tel-nummer-text">Telefoon nummer:</div>
            <div class="tel-nummer-nummer">sss</div>
        </div>
        <div class="openings-tijden">
            <div class="openings-tijden-text">Onze openings tijden</div>
            <div class="openings-tijden-werk-week">Maandag - vrijdag: 07.00 - 17.00 uur</div>
            <div class="openings-tijden-zaterdag">Zaterdag: Op afspraak</div>
            <div class="openings-tijden-zondag">Zondag: Gesloten</div>
        </div>
        <div class="links">
            <div class="links-text">Onze sociale media</div>
            <div class="logo-sm yt">
                <img class="yt-logo" src="assets\img\yt_logo.png" alt="YT LOGO">
                <div class="yt-link logo-link">https://youtube.com/</div>
            </div>
        </div>
    </div>
</main>
<?php
include('assets/core/footer.php');
?>
