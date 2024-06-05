<?php
include('core/header.php');
?>
    <?php
if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
    
} else {
    // Redirect naar uitloggen.php
    header("Location: ../../login/uitloggen.php");
    exit();
}
?>
<head>
    <title>Vragen</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<div class="row">

    <table class="table">
        <tr>
            <th>Vragen ID</th>
            <th>Categorie ID</th>
            <th>Type</th>
            <th>Afbeelding</th>
            <th>Vraag</th>
            <th>Feedback</th>
            <th>Optie 1</th>
            <th>Optie 2</th>
            <th>Optie 3</th>
        </tr>
        <?php
        // Controleer of de vragen_id parameter is meegegeven
        if (isset($_GET['id'])) {
            $vragen_id = $_GET['id'];

            // Query om alleen de rij met de opgegeven vragen_id op te halen
            $sql = "SELECT vragen_id, vragen_category_id, type, image, question, feedback, option_1, option_2, option_3 FROM vragen WHERE vragen_id = ? ORDER BY vragen_id ASC";
            $liqry = $con->prepare($sql);
            $liqry->bind_param('i', $vragen_id);

            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($vragen_id, $vragen_category_id, $type, $image, $question, $feedback, $option_1, $option_2, $option_3);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    if ($liqry->num_rows > 0) {
                        $liqry->fetch();
                        ?>
                        <tr>
                            <td><?php echo $vragen_id; ?></td>
                            <td><?php echo $vragen_category_id; ?></td>
                            <td><?php echo $type; ?></td>
                            <td><?php echo $image; ?></td>
                            <td><?php echo $question; ?></td>
                            <td><?php echo $feedback; ?></td>
                            <td><?php echo $option_1; ?></td>
                            <td><?php echo $option_2; ?></td>
                            <td><?php echo $option_3; ?></td>
                        </tr>
                    <?php
                    } else {
                        echo "Geen vraag gevonden met de opgegeven vragen_id.";
                    }
                }
                $liqry->close();
            }
        }
        ?>
    </table>

    <div class="row">
        <form action="" method="post"> <!-- Formulier toegevoegd -->
            <button type="submit" name="submit" class="button5">Delete</button> <!-- Knop toegevoegd binnen het formulier -->
            <input type="hidden" name="id" value="<?php echo $vragen_id; ?>"> <!-- Verborgen invoerveld toegevoegd om vragen-ID door te geven -->
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $vragen_id = $_POST["id"];

        // Query om de vraag met de opgegeven vragen_id te verwijderen
        $sql = "DELETE FROM vragen WHERE vragen_id = ?";
        $deleteqry = $con->prepare($sql);
        $deleteqry->bind_param('i', $vragen_id);

        if ($deleteqry->execute()) {
            $redirectUrl = BASEURL . "login/admin/admin_account.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error bij verwijderen vraag: " . $deleteqry->error;
        }

        $deleteqry->close();
    }
    ?>

    <?php
    include('../core/footer.php');
    ?>
