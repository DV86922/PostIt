<?php

//maak de verbinding
require '../config.php';
require '../../Classes/ClassGebruikers.php';
session_start();
$bericht = "";

// haal de naam uit de URL
$Naam = $_GET['Naam'];

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Zaterdag</title>
</head>
<body>
<?php
require_once "header_responsive.php";
?>
<div class="dagen">
<h1 class="dag">ZATERDAG</h1>
<form id="zoek">
    <label for="search">Search</label>
    <input id="search" type="search" pattern=".*\S.*" required>
    <span class="caret"></span>
</form>
<ul>
    <?php
    $query = "SELECT * FROM `Accounts` WHERE Gebruikersnaam = '{$Naam}'";
    // De query uitgevoerd en het resultaat opgevangen //
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
            $inGebruiker = new Gebruiker($item['GebruikerID'], $item['Gebruikersnaam'], $item['Wachtwoord'], $item['Email']);
            //GebruikerID veranderen in een getal //
            $gebruikerID = intval($inGebruiker->gebruikerID);
            // Query controleren of gebruikerID en dagID goed zijn //
            $query2 = "SELECT * FROM `Taken` WHERE GebruikerID = {$gebruikerID} AND DagID = 6";

            $result2 = mysqli_query($mysqli, $query2);
            if (mysqli_num_rows($result2) > 0) {
                while ($item = mysqli_fetch_assoc($result2)) {
                    // Tijd in de juiste format //
                    $TijdBegin = new DateTime($item['BeginTijd']);
                    $TijdEind = new DateTime($item['EindTijd']);
                    ?>
                    <li>
                        <div class="postIt">
                            <p class="tijd"><?= $TijdBegin->format('H:i'); ?> - <?= $TijdEind->format('H:i'); ?></p>
                            <h2><?= $item['TaakTitel'] ?></h2>
                            <p id="omschrijving"><?= $item['TaakOmschrijving'] ?></p>
                            <p class="pasaan"><a href="../pasaan.php?Naam=<?= $Naam ?>&id=<?= $item['TaakID'] ?>"><i
                                            class="fas fa-edit"></i></a></p>
                        </div>
                    </li>
                    <?php
                }
            }
        }
    }
    ?>
</ul>
</div>
</body>