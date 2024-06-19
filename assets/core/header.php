<?php
include ('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   
    <title>Tuinman</title>
</head>

<body>
    <div class="header">
        <div class="e">
            <img src="https://placehold.co/50x50" alt="PLACEHOLDER" class="logo-website header-logo">
            <div class="header-name">Henrik De Hovenier's Website</div>
        </div>
        <div class="f">
            <button class="btn btn-primary"><a href="<?= BASEURL ?>index.php" class="button-deco">Home</a></button>
            <button class="btn btn-primary button-deco"><a href="<?= BASEURL ?>design.php" class="button-deco">Design</a></button>
            <button class="btn btn-primary button-deco"><a href="<?= BASEURL ?>contact.php" class="button-deco">Contact</a></button>
        </div>
    </div>