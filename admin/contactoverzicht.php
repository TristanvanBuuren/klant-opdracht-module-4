<?php 
include('core/headeradmin.php');
?>
<div class="row">
        <table class="table">
            <!-- Rijtjes toevoegen met deze naam -->
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Bericht</th>
                <th>Tijd Verstuurt</th>
            </tr>
            <!-- De rijen met de data invullen -->
            <?php
            $counter = 1; // teller van de rij
            $sql = "SELECT id, naam, email, bericht, tijd_gemaakt FROM contact ORDER BY tijd_gemaakt DESC";
            $liqry = $con->prepare($sql);
            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($id, $naam, $email, $bericht, $tijd);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    while ($liqry->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $naam; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $bericht; ?></td>
                            <td><?php echo $tijd; ?></td>
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