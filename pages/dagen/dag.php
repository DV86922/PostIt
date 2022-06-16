<?php

//maak de verbinding
require '../config.php';
require '../../Classes/ClassGebruikers.php';
session_start();
$bericht = "";

// de dag uit de url halen //
$dagID = $_GET['Dag'];
// haal de naam uit de URL
$Naam = $_GET['Naam'];

$query = "SELECT Dagen FROM `Dagen` WHERE DagID = {$dagID}";

$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
while ($item = mysqli_fetch_assoc($result)) {

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="ajax.js" defer></script>
    <title><?= $item['Dagen'] ?></title>
</head>
<body>
<?php
require_once "header_responsive.php";
?>
<h1 class="dag"><?= strtoupper($item['Dagen']) ?></h1> <?php }
} ?>
<div class="dagen">
    <form id="zoek">
        <!--    Hier moet ik met de class de ingelogde gebruiker hebben. dan kan ik de id hebben. die controleer ik met tabel in taken op ajax.php-->
        <input id="naam" type="text" name="id" value="<?= $Naam ?>">
        <label for="search">Search</label>
        <!--    css nog toevoegen in github-->
        <input id="search" type="search" name="zoek" pattern=".*\S.*" required>
        <span class="caret"></span>
    </form>
    <div id="resultaat"></div>

    <button class="knop lichtRood" id="lichtGrijsPostIt"></button>
    <button class="knop lichtGeel" id="lichtGeelPostIt"></button>
    <button class="knop lichtBlauw" id="lichtBlauwPostIt"></button>
    <button class="knop lichtGroen" id="lichtGroenPostIt"></button>
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
                $query2 = "SELECT * FROM `Taken` WHERE GebruikerID = {$gebruikerID} AND DagID = {$dagID}";

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