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
<div class="row pd-l-1vw">
    <table class="table">
        <tr>
            <!-- Namen van rijtjes -->
            <th></th>
            <th></th>
            <th>ID</th>
            <th>Type</th>
            <th>Voorstukje</th>
            <th>Achterstuk</th>
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
                    <!-- Rijtjes teovoegen -->
                    <tr>
                        <td>
                            <button class="btn btn-warning"><a class="button-deco" href="edit_info.php?id=<?php echo $info_id; ?>">Wijzigen</a></button>
                        </td>
                        <td>
                            <!-- <a href="edit_product.php?info_id=<?php echo $info_id; ?>"><?php echo $info_id; ?></a> -->
                            <button class="btn btn-danger"><a class="button-deco" href="delete_info.php?id=<?php echo $info_id; ?>">Verwijderen</a></button>
                        </td>
                        <td><?php echo $info_id; ?></td>
                        <td>
                            <?php 
                            if ($info_type == 1){
                                echo $info_type . " - Contact info (Links)";
                            }
                            if ($info_type == 2){
                                echo $info_type . " - Werk info (Rechts)";
                            }
                            ?>
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
    <a class="button-deco btn btn-success mw-100p" href="./add_info.php">Toevoegen</a>
</div>
<?php
include('../core/footeradmin.php');
?>