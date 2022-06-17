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

$queryDagen = "SELECT Dagen FROM `Dagen` WHERE DagID = {$dagID}";

$resultDagen = mysqli_query($mysqli, $queryDagen);

if (mysqli_num_rows($resultDagen) > 0) {
while ($itemDagen = mysqli_fetch_assoc($resultDagen)) {


$queryAccounts = "SELECT * FROM `Accounts` WHERE Gebruikersnaam = '{$Naam}'";
// De query uitgevoerd en het resultaat opgevangen //
$resultAccounts = mysqli_query($mysqli, $queryAccounts);

if (mysqli_num_rows($resultAccounts) > 0) {
while ($item = mysqli_fetch_assoc($resultAccounts)) {
$inGebruiker = new Gebruiker($item['GebruikerID'], $item['Gebruikersnaam'], $item['Wachtwoord'], $item['Email']);
//GebruikerID veranderen in een getal //
$gebruikerID = intval($inGebruiker->gebruikerID);

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
    <title><?= $itemDagen['Dagen'] ?></title>
</head>
<body>
<?php
require_once "header_responsive.php";
?>
<h1 class="dag"><?= strtoupper($itemDagen['Dagen']) ?></h1> <?php }
}
?>
<div class="dagen">
    <form id="zoek">
        <input id="naamID" type="text" name="naamID" value="<?= $gebruikerID ?>">
        <input id="dagID" type="text" name="dagID" value="<?= $dagID ?>">
        <input id="naam" type="text" name="naam" value="<?= $Naam ?>">
        <label for="search">Search</label>
        <input id="search" type="search" name="zoek" pattern=".*\S.*" required>
        <span class="caret"></span>
        <div id="resultaat"></div>
    </form>

    <ul id="result" class="alles">
        <?php
        // Query controleren of gebruikerID en dagID goed zijn //
        $query = "SELECT * FROM `Taken` WHERE GebruikerID = {$gebruikerID} AND DagID = {$dagID}";

        $result = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($item = mysqli_fetch_assoc($result)) {
                // Tijd in de juiste format //
                $TijdBegin = new DateTime($item['BeginTijd']);
                $TijdEind = new DateTime($item['EindTijd']);
                ?>
                <li>
                    <div style="background-color: <?= $item['Kleur'] ?>" class="postIt">
                        <p class="tijd"><?= $TijdBegin->format('H:i'); ?> - <?= $TijdEind->format('H:i'); ?></p>
                        <h2 id="zoekPostIt"><?= $item['TaakTitel'] ?></h2>
                        <p id="omschrijving"><?= $item['TaakOmschrijving'] ?></p>
                        <p class="pasaan"><a
                                    href="../pasaan.php?Naam=<?= $Naam ?>&id=<?= $item['TaakID'] ?>&Dag=<?= $dagID ?>"><i
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
