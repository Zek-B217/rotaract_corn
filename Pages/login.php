<?php
    require "../PHP/constants.php";
    session_start();
    if (isset($_SESSION[$IS_LOGGED])){
        if ($_SESSION[$IS_LOGGED]){
            header("Location: ../admin.php");
        } else {
            echo "Fallito. Mi riferisco a te, non al login";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $json = json_decode(file_get_contents("../$CONFIG_FILE"),true);

        $inputPassword = $_POST[$PASSWORD];

        $savedPassword = $json[$PASSWORD];

        if (password_verify($inputPassword, $savedPassword)) {
            $_SESSION[$IS_LOGGED] = true;
        } else {
            $_SESSION[$IS_LOGGED] = false;
        }
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/loginStyle.css">
</head>
<body>
    <div id="loginContainer">
        <h1>È NECESSARIA L'AUTORIZZAZIONE</h1>
        <form action="login.php" method="post">
            <div>
                <label for="passwordInput">Password</label><br>
                <input type="password" name="password" id="passwordInput" required>
                <p onclick="togglePasswordVisibility()">Mostra password</p>
            </div>
            <br>
            <button type="submit">Accedi</button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            var x = document.getElementById("passwordInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>