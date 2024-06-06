<?php
include ('assets/core/header.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
    $errors = [];
    if (empty($naam)) {
        $errors[] = "Name is verplicht.";
    }
    if (empty($email)) {
        $errors[] = "Email is verplicht";
    }
    if (empty($tel)) {
        $errors[] = "Telefoon nummber is verplicht.";
    }
    if (empty($adress)) {
        $errors[] = "Product description is verplicht.";
    }
    if (empty($stad)) {
        $errors[] = "Manage storage name is verplicht.";
    }
    if (empty($postcode)) {
        $errors[] = "Invalid product price.";
    }
    if (empty($text_input) || !is_numeric($producten_beoordeling)) {
        $errors[] = "Invalid product rating.";
    }
    if (empty($errors)) {
        $sql = "INSERT INTO producten (category_id, producten_id, producten_naam, producten_tekst, producten_msName, producten_prijs, producten_beoordeling) VALUES (?,?,?,?,?,?,?)";
        $insertqry = $con->prepare($sql);
        if ($insertqry === false) {
            echo mysqli_error($con);
        } else {
            $insertqry->bind_param('iisssdd', $category_id, $producten_id, $producten_naam, $producten_tekst, $producten_msName, $producten_prijs, $producten_beoordeling);
            if ($insertqry->execute()) {
                echo "Product added successfully!";
                header("Location: index.php");
                exit();
            } else {
                echo "Error adding product: " . $insertqry->error;
            }
            $insertqry->close();
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
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
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe" name="naam">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="email" class="form-control" placeholder="name@example.com" aria-label="Email"
                    aria-describedby="basic-addon1" name="email">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+31</span>
                <input type="number" class="form-control" placeholder="0 6 00 00 00 00" aria-label="tel"
                    aria-describedby="basic-addon1" id="telefoon">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adress">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">stad</label>
                <input type="text" class="form-control" id="inputCity" name="stad">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">postcode</label>
                <input type="text" class="form-control" id="inputZip" name="postcode">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Vraag of opmerking</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text_input"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Versturen">
        </form>
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
            <div class="logo yt">
                <img class="yt-logo" src="assets\img\yt_logo.png" alt="YT LOGO">
                <div class="yt-link logo-link">https://youtube.com/</div>
            </div>
        </div>
</main>
<?php
include ('assets/core/footer.php');
?>