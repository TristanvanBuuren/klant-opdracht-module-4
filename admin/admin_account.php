
<?php
    include('core/header.php');
?>


   

    <div class="header">
    <?php
if (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd']) {
    
} else {
    // Redirect naar uitloggen.php
    header("Location: ../../login/uitloggen.php");
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
        <th>Vragen_id</th>
        <th>vragen_category</th>
        <th>type</th>
        <th>image</th>
        <th>question</th>
        <th>feedback</th>
        <th>option_1</th>
        <th>option_2</th>
        <th>option_3</th>
    </tr>
    <?php
$counter = 1; // teller van de rij
$sql = "SELECT vragen_id, vragen_category_id, type, image, question, feedback, option_1, option_2, option_3 FROM vragen ORDER BY vragen_id ASC";
$liqry = $con->prepare($sql);
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_result($vragen_id, $vragen_category_id, $type, $image, $question, $feedback, $option_1, $option_2, $option_3);
    if ($liqry->execute()) {
        $liqry->store_result();
        while ($liqry->fetch()) {
            ?>
            <tr>

            <td><a href="edit_vraag.php?id=<?php echo $vragen_id; ?>"><button class="button1">Edit</button></a></td>
                <td><a href="delete_vraag.php?id=<?php echo $vragen_id; ?>"><button class="button2">Delete</button></a></td>
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
            $counter++;
        }
    }
    $liqry->close();
}
?>

</table>
<div class="row">
    <div class="col-12">
        <a href="add_vraag.php"><button class="button3">Toevoegen</button></a>
    </div>
</div>
<?php
    include('../core/footer.php');
?>
