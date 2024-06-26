<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/klant-opdracht-module-4/assets/core/db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/login.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Theorie</title>
</head>

<body>
    <div class="header-admin">
        <div class="e">ADMIN PAGINA</div>
        <div class="f">
            <button class="btn btn-primary">
                <a href="<?= BASEURL ?>index.php" class="button-deco">Home</a>
            </button>
            <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true): ?>
                <button class="btn btn-primary">
                    <a href="account.php" class="button-deco">Account</a>
                </button>
                <button class="btn btn-primary">
                    <a href="uitloggen.php" class="button-deco">Uitloggen</a>
                </button>
            <?php elseif (isset($_SESSION['admin_ingelogd']) && $_SESSION['admin_ingelogd'] === true): ?>
                <button class="btn btn-primary">
                    <a href="<?= BASEURL_CMS ?>index.php" class="button-deco">Admin Account</a>
                    </button>
                <button class="btn btn-primary">
                    <a href="<?= BASEURL_LOGIN ?>uitloggen.php" class="button-deco">Uitloggen</a>
                    </button>
            <?php else: ?>
                <button class="btn btn-primary"><a href="login/login.php" class="button-deco">Inloggen</a></button>
            <?php endif; ?>
        </div>
        <div><a href="<?=BASEURL_CMS;?>contactoverzicht.php" class="btn btn-primary">Contact Overzicht</a></div>
                    <div><a href="<?=BASEURL_CMS;?>index.php" class="btn btn-primary">Tuin/review pagina</a></div>

                  
        <div class="g">
            <!-- <button class="btn btn-primary"><a class="button-deco" href="<?= BASEURL_CMS ?>admin_account.php">Admin thuispagina</a></button> -->
            <button class="btn btn-primary"><a class="button-deco" href="<?= BASEURL_CMS ?>informatie/">Informatie pagina</a></button>
        </div>
    
        
    </div>
    <?php
    if (!isset($_SESSION['admin_ingelogd']) || $_SESSION['admin_ingelogd'] !== true) {
        // Redirect naar uitloggen.php
        $redirectUrl = "../login/uitloggen.php";
        header("Location: " . $redirectUrl);
        exit();
    }
    ?>