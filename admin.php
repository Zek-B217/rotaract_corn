<?php
    require "PHP/constants.php";

    session_set_cookie_params(0); //distruggi la sessione all'uscita dal browser
    session_start();
    if (!isset($_SESSION[$IS_LOGGED]) || !$_SESSION[$IS_LOGGED]){
        header("Location: PHP/logout.php"); //Redirigo al logout in maniera da ripulire la sessione
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="CSS/adminStyle.css">
    <link rel="stylesheet" href="CSS/commonStyle.css">
</head>
<body>
    <div id="header">
        <a class="logoContainer" href="index.html"><img class="logo" src="Media/logo.png"></a>

        <h1 id="title">GESTIONE PAGINE</h1>

        <div id="buttons">
            <form action="PHP/logout.php" method="get">
                <button id="logoutBtn" type="submit">Logout</button>
            </form>
            
        </div>
    </div>
</body>
</html>