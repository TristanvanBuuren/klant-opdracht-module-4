<?php
include('core/headeradmin.php');

// Controleer of de databaseverbinding is ingesteld
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Variabelen voor de ingevoerde waarden
$id = '';
$foto = '';
$review = '';

// Query om bestaande gegevens op te halen als de id is opgegeven
if (isset($_GET['id'])) {
    $current_id = $_GET['id'];

    $sql = "SELECT id, foto, review FROM hoofdpagina WHERE id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param('i', $current_id);
    $stmt->execute();
    $stmt->bind_result($id, $foto, $review);
    $stmt->fetch();
    $stmt->close();
}

// Als het formulier is ingediend, gebruik dan de ingevoerde waarden
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $foto = htmlspecialchars($_POST['foto']);
    $review = htmlspecialchars($_POST['review']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Edit Review</title>
</head>
<body>
    <form method="post">
        <div class="mb-3">
            <label for="numberInput" class="form-label">ID</label>
            <input type="number" name="id" class="form-control" id="numberInput" placeholder="ID" value="<?php echo $id; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Foto</label>
            <input type="text" name="foto" class="form-control" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" required>
        </div>
        <div class="mb-3">
            <label for="textInput" class="form-label">Review</label>
            <input type="text" name="review" class="form-control" id="review" placeholder="Review" value="<?php echo $review; ?>" required>
        </div>
        <button type="submit" name="submit" class="button4">Wijzigen</button>
    </form>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $new_id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    // Controleer of de nieuwe id al in gebruik is door een andere review
    $check_sql = "SELECT COUNT(*) FROM hoofdpagina WHERE id = ? AND id != ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param('ii', $new_id, $current_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "Deze id is al in gebruik. Kies een andere id.";
    } else if ($new_id === false || $new_id <= 0) {
        echo "Ongeldige id. Voer een positief heel getal in.";
    } else if (!preg_match("/^[a-zA-Z0-9 ]*\.png$/", $foto)) {
        echo "Ongeldige foto. Gebruik alleen letters en cijfers en voeg '.png' toe aan het einde van de naam.";
    } else if (!preg_match("/^[a-zA-Z0-9 .,\"-]+(?:'?[a-zA-Z0-9 .,\"-])*$/", $review)) {
        echo "Ongeldige review. Gebruik alleen letters, cijfers, spaties, en de symbolen . , ' \" -";
    } else {
        $sql = "UPDATE hoofdpagina SET id = ?, foto = ?, review = ? WHERE id = ?";
        $updateqry = $con->prepare($sql);

        if ($updateqry === false) {
            die("Error preparing statement: " . $con->error);
        }

        $updateqry->bind_param('issi', $new_id, $foto, $review, $current_id);

        if ($updateqry->execute()) {
            $redirectUrl = BASEURL . "admin/admin_account.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error bij bijwerken review: " . $updateqry->error;
        }

        $updateqry->close();
    }
}
?>

<?php
include('core/footeradmin.php');
?>
