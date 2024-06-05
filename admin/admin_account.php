<?php
    include('core/headeradmin.php');
?>

<div class="header">
    <?php
   
    if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
        // De gebruiker is ingelogd, laat de inhoud van admin_account.php zien
    } else {
        // Redirect naar adminlogin.php
        header("Location: ../login/adminlogin.php");
        exit();
    }
    ?>

    <head>
        <title>Producten</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <div class="row">
        <table class="table">
            <tr>
                <th>EDIT</th>
                <th>DELETE</th>
                <th>ID</th>
                <th>Foto</th>
                <th>Review</th>
            </tr>
            <?php
            $counter = 1; // teller van de rij
            $sql = "SELECT id, foto, review FROM hoofdpagina ORDER BY id ASC";
            $liqry = $con->prepare($sql);
            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($id, $foto, $review);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    while ($liqry->fetch()) {
                        ?>
                        <tr>
                            <td><a href="edit.php?id=<?php echo $id; ?>"><button class="button1">Edit</button></a></td>
                            <td><a href="delete.php?id=<?php echo $id; ?>"><button class="button2">Delete</button></a></td>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $foto; ?></td>
                            <td><?php echo $review; ?></td>
                        </tr>
                        <?php
                        $counter++;
                    }
                }
                $liqry->close();
            }
            ?>
        </table>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="add.php"><button class="button3">Toevoegen</button></a>
        </div>
    </div>

<?php
    include('core/footeradmin.php');
?>
