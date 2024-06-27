<?php
include('core/headerlogin.php');
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">ADMIN Login Page</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">ADMIN Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="./login.php" class="text-info">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST["username"];
    $admin_password = $_POST["password"];

    // Query om de gebruiker op te halen uit de database
    $sql = "SELECT * FROM admin_login WHERE username = '$admin_username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifieer het wachtwoord
        $password_column_name = "password"; // Vervang dit door de juiste kolomnaam voor het wachtwoord
        if ($admin_password == $row[$password_column_name]) {
            $_SESSION['admin_ingelogd'] = true;
            $_SESSION['username'] = $admin_username;
            $_SESSION['user_id'] = $row['id']; // Sla het id van de gebruiker op in een sessievariabele
            $redirectUrl = "../admin/index.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            $error_message = "Ongeldige gebruikersnaam of admin wachtwoord.";
        }
    } else {
        $error_message = "Ongeldige gebruikersnaam of admin wachtwoord.";
    }
}
?>

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
</style>

<?php
include('core/footerlogin.php');
?>