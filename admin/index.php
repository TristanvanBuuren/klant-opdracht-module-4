<?php 
include('core/headeradmin.php');
// echo BASEURL_CMS
?>

<div class="row pd-l-1vw">
        <table class="table">
            <tr>
                <th>EDIT</th>
                <th>DELETE</th>
                <th>ID</th>
                <th>Foto</th>
                <th>Review</th>
                <th>Persoon</th>
            </tr>
            <?php
            $counter = 1; // teller van de rij
            $sql = "SELECT id, foto, review, persoon FROM hoofdpagina ORDER BY id ASC";
            $liqry = $con->prepare($sql);
            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($id, $foto, $review, $persoon);
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
                            <td><?php echo $persoon; ?></td>
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