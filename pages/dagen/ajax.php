<?php

require '../config.php';
// zoek uitlezen
$zoek = $_POST['zoek'];
$naam = $_POST['naam'];

// Ik heb een query aangemaakt //
$query = "SELECT * FROM Taken, Accounts WHERE TaakTitel LIKE '" . $zoek . "%' AND Gebruikersnaam = '" . $naam . "'";

$result = mysqli_query($mysqli, $query);
// Controleren of het resultaat is gelukt //
if ($result) {
//        header("Location: profiel.php?Naam=$Naam");
// Ik heb hier een tabel aangemaakt met alle titels uit de database //
    while ($item = mysqli_fetch_assoc($result)) {
        // Hier toon ik de items //

        if($item['TaakTitel'] != ""){
            echo "- " . $item['TaakTitel'] . "<br>";
        }
        if($item['TaakOmschrijving'] != ""){
            echo "- " . $item['TaakOmschrijving'] . "<br>";
        }

    }

}

