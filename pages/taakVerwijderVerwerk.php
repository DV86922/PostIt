<?php
// Database-verbinding //
require 'config.php';
//Naam en datumuitlezen //
$Naam = $_GET['Naam'];
$taakID = $_GET['Taak'];

// Als het ID niet leeg is wordt de if uitgevoerd //
if ($taakID != "") {

    // Een query aangemaakt op het item de verwijderen //
    $query = "DELETE FROM Taken WHERE TaakID ='" . $taakID . "'";

    $result = mysqli_query($mysqli, $query);
    // Gelukt //
    if ($result) {
        echo "Het item is verwijderd<br/>";
        header("Location: ../index.php?Naam=" . $Naam);
        exit();
    } // Niet gelukt //
    else {
        echo "FOUT bij verwijderen<br/>";
        echo $query . "<br/>";
        echo mysqli_error($mysqli);
    }
} else {
    echo "Geen ID gevonden...<br/>";
}

