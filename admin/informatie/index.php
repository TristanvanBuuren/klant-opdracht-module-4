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
        $sql = "SELECT info_id, info_type, info_prefix, info_tekst FROM informatie";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_id, $info_type, $info_prefix, $info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    ?>
                    <tr>
                        <td>
                            <button class="btn btn-warning"><a class="button-deco" href="edit_info.php?id=<?php echo $info_id; ?>">EDIT</a></button>
                        </td>
                        <td>
                            <!-- <a href="edit_product.php?info_id=<?php echo $info_id; ?>"><?php echo $info_id; ?></a> -->
                            <button class="btn btn-danger"><a class="button-deco" href="delete_info.php?id=<?php echo $info_id; ?>">DELETE</a></button>
                        </td>
                        <td><?php echo $info_id; ?></td>
                        <td>
                            <?php echo $info_type; ?>
                        </td>
                        <td><?php echo $info_prefix; ?></td>
                        <td><?php echo $info_tekst; ?></td>
                    </tr>
                    <?php
                }
            }
            $liqry->close();
        }
        ?>
    </table>
    <a class="button-deco btn btn-success" href="./add_info.php">ADD</a>
</div>
<?php
include('../core/footeradmin.php');
?>