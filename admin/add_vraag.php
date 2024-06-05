<?php
include('core/header.php');

// Controleer of de databaseverbinding is ingesteld
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
    
} else {
    // Redirect naar uitloggen.php
    header("Location: ../../login/uitloggen.php");
    exit();
}

// Variabelen voor de ingevoerde waarden
$vragen_id = '';
$vragen_category_id = '';
$type = '';
$image = '';
$question = '';
$feedback = '';
$option_1 = '';
$option_2 = '';
$option_3 = '';

// Als het formulier is ingediend, gebruik dan de ingevoerde waarden
if (isset($_POST['submit'])) {
    $vragen_id = filter_var($_POST['vragen_id'], FILTER_VALIDATE_INT);
    $vragen_category_id = filter_var($_POST['vragen_category_id'], FILTER_VALIDATE_INT);
    $type = filter_var($_POST['type'], FILTER_VALIDATE_INT);
    $image = htmlspecialchars($_POST['image']);
    $question = htmlspecialchars($_POST['question']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $option_1 = htmlspecialchars($_POST['option_1']);
    $option_2 = htmlspecialchars($_POST['option_2']);
    $option_3 = htmlspecialchars($_POST['option_3']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Add Vraag</title>
</head>
<body>
    <form method="post">
        <div class="mb-3">
            <label for="numberInput" class="form-label">Vragen ID</label>
            <input type="number" name="vragen_id" class="form-control" id="numberInput" placeholder="Vragen ID" value="<?php echo $vragen_id; ?>" required>
        </div>
        <div class="mb-3">
            <label for="numberInput" class="form-label">Categorie ID</label>
            <input type="number" name="vragen_category_id" class="form-control" id="numberInput" placeholder="Categorie ID" value="<?php echo $vragen_category_id; ?>" required>
        </div>
        <div class="mb-3">
            <label for="numberInput" class="form-label">Type</label>
            <input type="number" name="type" class="form-control" id="numberInput" placeholder="Type (0 of 1)" value="<?php echo $type; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Afbeelding</label>
            <input type="text" name="image" class="form-control" id="image" placeholder="Afbeelding" value="<?php echo $image; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Vraag</label>
            <input type="text" name="question" class="form-control" id="question" placeholder="Vraag" value="<?php echo $question; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Feedback</label>
            <input type="text" name="feedback" class="form-control" id="feedback" placeholder="Feedback" value="<?php echo $feedback; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Optie 1</label>
            <input type="text" name="option_1" class="form-control" id="option_1" placeholder="Optie 1" value="<?php echo $option_1; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Optie 2</label>
            <input type="text" name="option_2" class="form-control" id="option_2" placeholder="Optie 2" value="<?php echo $option_2; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Optie 3</label>
            <input type="text" name="option_3" class="form-control" id="option_3" placeholder="Optie 3" value="<?php echo $option_3; ?>" required>
        </div>
        
        <button type="submit" name="submit" class="button4">Toevoegen</button>
    </form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $new_vragen_id = filter_var($_POST['vragen_id'], FILTER_VALIDATE_INT);

    // Controleer of de nieuwe vragen_id al in gebruik is
    $check_sql = "SELECT COUNT(*) FROM vragen WHERE vragen_id = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param('i', $new_vragen_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "Deze vragen_id is al in gebruik. Kies een andere vragen_id.";
    } else if ($new_vragen_id === false || $new_vragen_id <= 0) {
        echo "Ongeldige vragen_id. Voer een positief heel getal in.";
    } else if ($vragen_category_id === false || $vragen_category_id <= 0) {
        echo "Ongeldige categorie_id. Voer een positief heel getal in.";
    } else if ($type !== 0 && $type !== 1) {
        echo "Ongeldige type. Voer 0 of 1 in.";
    } else if (!preg_match("/^[a-zA-Z0-9 ]*\.png$/", $image)) {
        echo "Ongeldige afbeelding. Gebruik alleen letters en cijfers en voeg '.png' toe aan het einde van de naam.";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $question)) {
        echo "Ongeldige vraag. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $feedback)) {
        echo "Ongeldige feedback. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $option_1)) {
        echo "Ongeldige optie 1. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $option_2)) {
        echo "Ongeldige optie 2. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $option_3)) {
        echo "Ongeldige optie 3. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else {
        $sql = "INSERT INTO vragen (vragen_id, vragen_category_id, type, image, question, feedback, option_1, option_2, option_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertqry = $con->prepare($sql);

        if ($insertqry === false) {
            die("Error preparing statement: " . $con->error);
        }

        $insertqry->bind_param('iiissssss', $new_vragen_id, $vragen_category_id, $type, $image, $question, $feedback, $option_1, $option_2, $option_3);

        if ($insertqry->execute()) {
            $redirectUrl = BASEURL . "login/admin/admin_account.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error bij toevoegen vraag: " . $insertqry->error;
        }

        $insertqry->close();
    }
}
?>

<?php
include('../core/footer.php');
?>
