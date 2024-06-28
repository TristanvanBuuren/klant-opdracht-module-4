<?php
include('../core/headeradmin.php');

if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
    // Ga verder met de code
} else {
    // Redirect naar uitloggen.php
    header("Location: ../../login/uitloggen.php");
    exit();
}
?>
Wil je het zeker weten verwijderen?
<div class="row">
    <table class="table">
        <!-- Namen van de rij -->
        <tr>
            <th></th>
            <th></th>
            <th>ID</th>
            <th>Type</th>
            <th>Voorstukje</th>
            <th>Achterstuk</th>
        </tr>
<?php
// De rij word verwijdert omdat de knop is ingeklikt
if (isset($_GET['info_id'])) {
    $info_id = $_GET['info_id'];
    $sql = "DELETE FROM informatie WHERE `info_id` = ?";
    $deleteqry = $con->prepare($sql);
    if ($deleteqry === false) {
        echo mysqli_error($con);
    } else {
        $deleteqry->bind_param('i', $info_id);
        if ($deleteqry->execute()) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product: " . $deleteqry->error;
        }
        $deleteqry->close();
    }
  // Terug naar hoofdpagina
    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT info_id, info_type, info_prefix,  info_tekst FROM informatie WHERE info_id = ?";
    $liqry = $con->prepare($sql);
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_param('i', $_GET['id']);
        $liqry->bind_result($info_id, $info_type, $info_prefix, $info_tekst);
        if ($liqry->execute()) {
            $liqry->store_result();
            while ($liqry->fetch()) {
                ?>
                <tr>
                <td>
                        <button class="btn btn-danger"><a class="button-deco" href="delete_info.php?info_id=<?php echo $info_id; ?>">JA</a></button>
                    </td>
                    <td>
                        <button class="btn btn-warning"><a class="button-deco" href="./index.php">NO</a></button>
                    </td>
                    <td><?php echo $info_id; ?></td>
                        <td>
                            <?php echo $info_type; ?>
                        </td>
                        <td>
                            <?php echo $info_prefix; ?>
                        </td>
                        <td><?php echo $info_tekst; ?></td>
                    </tr>
                    <?php
                }
            }
            $liqry->close();
        }
}
?>
</table>
<?php
include ('../core/footeradmin.php');
?>
