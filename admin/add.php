<?php
include('core/headeradmin.php');

// Controleer of de databaseverbinding is ingesteld
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
    // Ga verder met de code
} else {
    // Redirect naar uitloggen.php
    header("Location: ../../login/uitloggen.php");
    exit();
}

// Variabelen voor de ingevoerde waarden
$id = '';
$foto = '';
$review = '';
$persoon = '';

// Als het formulier is ingediend, gebruik dan de ingevoerde waarden
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $foto = htmlspecialchars($_POST['foto']);
    $review = htmlspecialchars($_POST['review'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); // Ontsmetten en behouden speciale tekens
    $persoon = htmlspecialchars($_POST['persoon']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Add Review</title>
</head>
<body>
    <form method="post">
        <div class="mb-3">
            <label for="numberInput" class="form-label">ID</label>
            <input type="number" name="id" class="form-control" id="numberInput" placeholder="ID" value="<?php echo $id; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Foto</label>
            <input type="text" name="foto" class="form-control" id="foto" placeholder="Foto" value="<?php echo $foto; ?>">
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Review</label>
            <textarea name="review" class="form-control" id="review" placeholder="Review"><?php echo $review; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Persoon</label>
            <input type="text" name="persoon" class="form-control" id="persoon" placeholder="Persoon" value="<?php echo $persoon; ?>">
        </div>
        <button type="submit" name="submit" class="button4">Toevoegen</button>
    </form>
</body>
</html>

<?php

if (isset($_POST['submit'])) {
    $new_id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    // Controleer of de nieuwe id al in gebruik is
    $check_sql = "SELECT COUNT(*) FROM hoofdpagina WHERE id = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param('i', $new_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "Deze id is al in gebruik. Kies een andere id.";
    } else if ($new_id === false || $new_id <= 0) {
        echo "Ongeldige id. Voer een positief heel getal in.";
    } else if ((!empty($review) && empty($persoon)) || (empty($review) && !empty($persoon))) {
        echo "Als je de review invult, moet je ook de persoon invullen, en andersom.";
    } else if (empty($foto) && empty($review) && empty($persoon)) {
        echo "Vul ofwel de foto ofwel de review en persoon in, naast de verplichte id.";
    } else if (!empty($foto) && !preg_match("/^[a-zA-Z0-9 ]*\.png$/", $foto)) {
        echo "Ongeldige foto. Gebruik alleen letters en cijfers en voeg '.png' toe aan het einde van de naam.";
    } else if (!empty($persoon) && !preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $persoon)) {
        echo "Ongeldige persoon. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else {
        $sql = "INSERT INTO hoofdpagina (id, foto, review, persoon) VALUES (?, ?, ?, ?)";
        $insertqry = $con->prepare($sql);

        if ($insertqry === false) {
            die("Error preparing statement: " . $con->error);
        }

        $insertqry->bind_param('isss', $new_id, $foto, $review, $persoon);

        if ($insertqry->execute()) {
            $redirectUrl = BASEURL . "admin/admin_account.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error bij toevoegen review: " . $insertqry->error;
        }

        $insertqry->close();
    }
}
?>

<?php
include('core/footeradmin.php');
?>
