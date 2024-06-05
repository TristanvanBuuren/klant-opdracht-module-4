<?php
include('core/headeradmin.php');

?>

<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<div class="row">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Review</th>
        </tr>
        <?php
        // Controleer of de id parameter is meegegeven
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query om alleen de rij met de opgegeven id op te halen
            $sql = "SELECT id, foto, review FROM hoofdpagina WHERE id = ?";
            $liqry = $con->prepare($sql);
            $liqry->bind_param('i', $id);

            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($id, $foto, $review);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    if ($liqry->num_rows > 0) {
                        $liqry->fetch();
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $foto; ?></td>
                            <td><?php echo $review; ?></td>
                        </tr>
                        <?php
                    } else {
                        echo "Geen review gevonden met de opgegeven id.";
                    }
                }
                $liqry->close();
            }
        }
        ?>
    </table>

    <div class="row">
        <form action="" method="post">
            <button type="submit" name="submit" class="button5">Delete</button>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST["id"];

        // Query om de review met de opgegeven id te verwijderen
        $sql = "DELETE FROM hoofdpagina WHERE id = ?";
        $deleteqry = $con->prepare($sql);
        $deleteqry->bind_param('i', $id);

        if ($deleteqry->execute()) {
            $redirectUrl = BASEURL . "admin/admin_account.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error bij verwijderen review: " . $deleteqry->error;
        }

        $deleteqry->close();
    }
    ?>

<?php
include('core/footeradmin.php');
?>
