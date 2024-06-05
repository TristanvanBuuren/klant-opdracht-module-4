<?php

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifieer de gebruikersnaam en het wachtwoord
    // ...
    
    if ($gebruiker_is_geldig) {
        // Stel de sessievariabele in om aan te geven dat de gebruiker is ingelogd
        $_SESSION['ingelogd'] = true;
        // Redirect naar de gewenste pagina
        header("Location: index.php");
        exit();
    }
}
?>
<?php
include('core/headerlogin.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login Page</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="./register.php" class="text-info">Register here</a>
                            </div>
                            <div id="admin-link" class="text-right">
                                <a href="./adminlogin.php" class="text-info">Login as Admin</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
// Verifieer de gebruikersnaam en het wachtwoord
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query om de gebruiker op te halen uit de database
    $stmt = $con->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifieer het wachtwoord
        if (password_verify($password, $row["password"])) {
            // Gebruiker is geldig, start de sessie en stuur door naar blogs
            $_SESSION['ingelogd'] = true;
            $_SESSION['username'] = $username;
           $_SESSION['user_id'] = $row['id']; // Sla het id van de gebruiker op in een sessievariabele
            $redirectUrl = BASEURL . "index.php";
            header("Location: " . $redirectUrl);
            $_SESSION['username'] = $username;
            exit();
        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        echo "Ongeldige gebruikersnaam of wachtwoord.";
    }

    $stmt->close();
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