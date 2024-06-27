<?php
include('../core/headeradmin.php');

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
?>
Are you sure you want to delete:
<div class="row">
    <table class="table">
        <tr>
            <th></th>
            <th></th>
            <th>info_id</th>
            <th>info_type</th>
            <th>info_prefix</th>
            <th>info_tekst</th>
        </tr>
<?php
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
    // Redirect to prevent resubmission
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
                        <button class="btn btn-danger"><a class="button-deco" href="delete_info.php?info_id=<?php echo $info_id; ?>">YES</a></button>
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
