<?php
include ('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets\img\hark-removebg-preview.png">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <title>Tuinman</title>
</head>

<body class="bg-6F8587">
    <div class="header">
        <div class="e">
            <img src="assets\img\hark-removebg-preview.png" alt="logo" class="logo-website header-logo">
            <div class="header-name">Henrik De Hovenier's Website</div>
        </div>
        <div class="f">
            <a href="<?= BASEURL ?>index.php" class="btn-left nav-buttons button-deco">Home</a>
            <a href="<?= BASEURL ?>diensten.php" class="btn-middle nav-buttons button-deco">Diensten</a>
            <a href="<?= BASEURL ?>contact.php" class="btn-right nav-buttons button-deco">Contact</a>
        </div>
        <div class="dropdown">
            <img src="assets/img/menu.png" alt="menu">
            <div class="dropdown-buttons">
                <a href="<?= BASEURL ?>index.php" class="btn-left nav-buttons-dropdown button-deco">Home</a>
                <a href="<?= BASEURL ?>diensten.php" class="btn-middle nav-buttons-dropdown button-deco">Diensten</a>
                <a href="<?= BASEURL ?>contact.php" class="btn-right nav-buttons-dropdown button-deco">Contact</a>
            </div>
        </div>
    </div>