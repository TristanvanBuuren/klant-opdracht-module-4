<?php
include ('../core/headeradmin.php');

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

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["submit"])) {
    // Sanitize inputs
    $info_id = test_input($_POST['info_id']);
    $info_type = test_input($_POST['info_type']);
    $info_prefix = test_input($_POST['info_prefix']);
    $info_tekst = test_input($_POST['info_tekst']);

    // Validate inputs
    $errors = [];
    if (empty($info_id) || !is_numeric($info_id)) {
        $errors[] = "Invalid info ID.";
    }
    if (empty($info_type)) {
        $errors[] = "info type is required.";
    }
    if (empty($info_prefix)) {
        $errors[] = "info prefix is required.";
    }
    if (empty($info_tekst)) {
        $errors[] = "info tekst is required.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO informatie (info_id, info_type, info_tekst) VALUES (?,?,?)";
        $insertqry = $con->prepare($sql);
        if ($insertqry === false) {
            echo mysqli_error($con);
        } else {
            $insertqry->bind_param('iss', $info_id, $info_type, $info_tekst);
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
<form action="add_info.php" method="post">
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingInput" placeholder="0" name="info_id" required>
        <label for="floatingInput">Info ID</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-control" id="floatingInput" name="info_type">
            <option selected>Open to pick an option</option>
            <option value="1">1 - Contact</option>
            <option value="2">2 - Werktijden</option>
        </select>
        <label for="floatingInput">Info Type</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-control" id="floatingInput" name="info_prefix">
            <option selected>Open to pick an option</option>
            <option value="tel">1 - tel</option>
            <option value="sms">2 - sms</option>
            <option value="mailto">3 - email</option>
            <option value="Maandag - vrijdag:">4 - Maandag - vrijdag:</option>
            <option value="Zaterdag:">5 - Zaterdag:</option>
            <option value="Zondag:">6 - Zondag:</option>
        </select>
        <label for="floatingInput">Info Prefix</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="tel: 00000000" name="info_tekst" required>
        <label for="floatingInput">Info Tekst</label>
    </div>
    <input type="submit" name="submit" value="Save">
</form>
<?php
include ('../core/footeradmin.php');
?>