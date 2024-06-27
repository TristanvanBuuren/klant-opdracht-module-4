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

    // MARK: Update qry
    if (empty($errors)) {
        // Prepare the update query
        $sql = "UPDATE informatie SET info_id = ?, info_type = ?, info_prefix = ?, info_tekst = ? WHERE info_id = ?";
        $updateqry = $con->prepare($sql);
        if ($updateqry === false) {
            echo mysqli_error($con);
        } else {
            $updateqry->bind_param('iissi', $info_id, $info_type, $info_prefix, $info_tekst, $_GET['info_id']);
            if ($updateqry->execute()) {
                echo "Product updated successfully!";
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating product: " . $updateqry->error;
            }
            $updateqry->close();
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

$id = $_GET['id'];

// Fetch the product data for editing
$sql = "SELECT info_id, info_type, info_prefix, info_tekst FROM informatie WHERE info_id = ?";
$liqry = $con->prepare($sql);
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_param('i', $id);
    $liqry->bind_result($info_id, $info_type, $info_prefix, $info_tekst);
    if ($liqry->execute()) {
        $liqry->store_result();
        if ($liqry->num_rows > 0) {
            $liqry->fetch();
            ?>
            <form action="edit_info.php?info_id=<?php echo $info_id; ?>" method="post">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="0" name="info_id" value="<?php echo $info_id ?>" required>
                    <label for="floatingInput">ID</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control" id="floatingInput" name="info_type">
                        <!-- <option selected>Open to pick an option</option> -->
                        <option value="1" <?php if($info_type === 1){echo "selected"; }?>>1 - Contact</option>
                        <option value="2" <?php if($info_type === 2){echo "selected"; }?>>2 - Werktijden</option>
                    </select>
                    <label for="floatingInput">Type</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control" id="floatingInput" name="info_prefix">
                        <!-- <option selected>Open to pick an option</option> -->
                        <option value="tel" <?php if($info_prefix === 1){echo "selected"; }?>>1 - tel</option>
                        <option value="sms" <?php if($info_prefix === 2){echo "selected"; }?>>2 - sms</option>
                        <option value="mailto" <?php if($info_prefix === 3){echo "selected"; }?>>3 - email</option>
                        <option value="Maandag - vrijdag:" <?php if($info_prefix === 4){echo "selected"; }?>>4 - Maandag - vrijdag:</option>
                        <option value="Zaterdag:" <?php if($info_prefix === 5){echo "selected"; }?>>5 - Zaterdag:</option>
                        <option value="Zondag:" <?php if($info_prefix === 6){echo "selected"; }?>>6 - Zondag:</option>
                    </select>
                    <label for="floatingInput">Voorstukje</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="00000000" name="info_tekst" value="<?php echo $info_tekst ?>" required>
                    <label for="floatingInput">Achterstuk</label>
                </div>
                <button type="submit" name="submit"class="button4" value="Save">Wijzigen</button>
            </form>
            <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Error executing query: " . $liqry->error;
    }
    $liqry->close();
}


include ('../core/footeradmin.php');
?>