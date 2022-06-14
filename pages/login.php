<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../media/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Inloggen</title>
</head>
<body>

<?php
//maak de verbinding
require 'config.php';
session_start();
$bericht = "";

if (isset($_POST['submit'])) {

    // gebruikersnaam een wachtwoord uitlezen
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];

    $stmt = $mysqli->prepare("SELECT * FROM Accounts WHERE Gebruikersnaam=? AND Wachtwoord=md5(?)");
    $stmt->bind_param("ss", $gebruikersnaam, $wachtwoord);
    $stmt->execute();
    $result = $stmt->get_result();

    $rij = mysqli_fetch_array($result);
    if (is_array($rij)) {
        $_SESSION['Wachtwoord'] = $rij['Wachtwoord'];
        $_SESSION['Gebruikersnaam'] = $rij['Gebruikersnaam'];
    } else {
        $bericht = "Ongeldige gebruikersnaam of wachtwoord";
    }

    if (isset($_SESSION['Gebruikersnaam'], $_SESSION['Wachtwoord'])) {
//        header("Location:profiel.php?Naam=" . $gebruikersnaam);
        header("Location:dagen/maandag.php?Naam=" . $gebruikersnaam);
    }
}

?>


<div class="main">
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="logo">
        </div>
        <div class="text-center mt-4 name">
            Post it!
        </div>
        <form action="" id="login" method="post">
            <div class="text-center mt-4 bericht"><?php if ($bericht != "") {
                    echo $bericht;
                } ?></div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input class="input" type="text" id="userName" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input class="input" type="password" id="pwd" name="Wachtwoord" placeholder="Wachtwoord" required>
            </div
            <div class="center">
                <input class="btn mt-3" type="submit" name="submit" value="Verzend">
                <input class="btn mt-3" type="reset">
            </div>
        </form>
    </div>
</div>



</body>
