<?php

//maak de verbinding
require 'config.php';
session_start();
$bericht = "";

// haal de naam uit de URL
$Naam = $_GET['Naam'];

if (isset($_POST['pasaanSubmit'])) {

    $gebruikerID = $_POST['gebruikerID'];
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
    $email = $_POST['email'];

    $query = "UPDATE Accounts SET Gebruikersnaam = '{$gebruikersnaam}', ";
    $query .= " Wachtwoord = md5('{$wachtwoord}'), Email = '{$email}'";
    $query .= " WHERE GebruikerID = {$gebruikerID}";

    $result = mysqli_query($mysqli, $query);


    if($result){
        header("Location:profiel.php?Naam=" . $gebruikersnaam);
    }

}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Inloggen</title>
</head>
<body>
<aside class="instellingen">
    <header>
        <h1><i class="fas fa-cog"></i></h1>
    </header>
    <div class="tekst">

        <form action="" id="instelling" method="post">
            <?php
            // Query aan gemaakt //
            $query = "SELECT * FROM `Accounts` WHERE Gebruikersnaam = '{$Naam}'";
            // De query uitgevoerd en het resultaat opgevangen //
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($item = mysqli_fetch_assoc($result)) {

                    ?>
                    <input hidden type="text" name="gebruikerID" value="<?= $item['GebruikerID'] ?>">
                    <p><strong>Gebruikersnaam: </strong><input class="input" type="text" name="gebruikersnaam" value="<?= $item['Gebruikersnaam'] ?>" disabled></p>
                    <p><strong>Wachtwoord:</strong><input class="input" type="password" name="wachtwoord" placeholder="******" disabled></p>
                    <p><strong>E-mail: </strong><input class="input" type="email" name="email" value="<?= $item['Email'] ?>" disabled></p>
                    <?php
                }
            }
            ?>
            <label id="pasaan" for="button"><i class="fas fa-sliders-h"></i></label>
            <input type="button" name="edit"  id="button" onclick="enableInput()" hidden>
            <p id="bevestiging">
                <label for="check"><i class="fas fa-check-circle"></i></label>
                <input type="submit" id="check" name="pasaanSubmit" hidden>
            </p>
        </form>
    </div>
    <a href="loguit.php">loguit</a>

</aside>


<script>
    // Functie voor reservering wijzigen

    function enableInput() {
        document.querySelectorAll('input').forEach(element => element.disabled = false);

        document.getElementById('bevestiging').style.display = "inline-block";
    }
</script>


</body>