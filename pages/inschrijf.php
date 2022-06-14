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
    <title>Inschrijven</title>
</head>
<body>

<?php
// De verbinding toevoegen //
require 'config.php';

$bericht = "";

if (isset($_POST['inschrijving'])) {
    // De gebruikersnaam, wachtwoord en email uitlezen //
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
    $email = $_POST['Email'];

    // Controleren of de variabelen niet leeg zijn //
    if ($gebruikersnaam == "" || $wachtwoord == "" || $email == "") {
        $bericht = "Niet alle velden zijn ingevuld.";

    } // Anders de query invoeren om die variabelen in te vullen in de database //
    else {
        // Controleren of de gebruikersnaam al bestaat //
        $sql = "SELECT * FROM Accounts WHERE Gebruikersnaam='" . $gebruikersnaam . "'";
        $result = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($result) > 0) {
            $bericht = "Dit gebruikersnaam bestaat al!";
        } else {
            // Controleren of de email al bestaat //
            $sql = "SELECT * FROM Accounts WHERE Email='" . $email . "'";
            $result = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($result) > 0) {
                $bericht = "Dit email is al in gebruik!";
            } else {
                // het wordt toegevoegd aan de tabel //
                $query = "INSERT INTO Accounts";
                $query .= " (Gebruikersnaam, Wachtwoord, Email)";
                $query .= " VALUES ('{$gebruikersnaam}', md5('{$wachtwoord}'), '{$email}')";
            }
        }
    }

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo "Registratie gelukt!";
        header("Location:login.php");
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
        <form action="" id="inschrijf" method="post">
            <div class="text-center mt-4 bericht"><?php if ($bericht != "") {
                    echo $bericht;
                } ?></div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input class="input" type="text" id="userName" name="Gebruikersnaam" placeholder="Gebruikersnaam"
                       required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input class="input" type="password" id="pwd" name="Wachtwoord" placeholder="Wachtwoord" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-envelope"></span>
                <input class="input" type="email" id="mail" name="Email" placeholder="E-mail" required>
            </div>
            <div class="center">
                <input class="btn mt-3" type="submit" name="inschrijving" value="Verzend">
                <input class="btn mt-3" type="reset">
            </div>
        </form>
    </div>
</div>


</body>
