<?php
include('core/header.php');


// Gebruikersnaam validatie
$usernameErr = "";
$username = isset($_POST["username"]) ? $_POST["username"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Gebruikersnaam is verplicht.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $_POST["username"])) {
        $usernameErr = "Ongeldige gebruikersnaam. Alleen letters, cijfers en underscores zijn toegestaan.";
    } elseif (strlen($_POST["username"]) < 4 || strlen($_POST["username"]) > 20) {
        $usernameErr = "Gebruikersnaam moet tussen 4 en 20 tekens lang zijn.";
    }
}

// Wachtwoord validatie
$passwordErr = "";
$password = isset($_POST["password"]) ? $_POST["password"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
        $passwordErr = "Wachtwoord is verplicht.";
    } 
}

// Controleer of er fouten zijn
if (empty($usernameErr) && empty($passwordErr)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hash het wachtwoord voor opslag in de database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Voeg de nieuwe gebruiker toe aan de database
        $stmt = $con->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "Nieuwe gebruiker is succesvol geregistreerd.";
            $_SESSION['ingelogd'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; // Sla het id van de gebruiker op in een sessievariabele
            $redirectUrl = BASEURL . "index.php";
            header("Location: " . $redirectUrl);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        // Wis de ingevoerde waarden na een succesvolle registratie
        $username = "";
        $password = "";
    }
} else {
    // Toon de foutmeldingen
    echo $usernameErr . "<br>" . $passwordErr;
}
?>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Register Page</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Register</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username;?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control" value="<?php echo $password;?>">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox" <?php echo isset($_POST['remember-me']) ? 'checked' : ''; ?>></span></label><br>
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

<style>
    body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>

<?php
include('core/footer.php');
?>