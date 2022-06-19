<?php

//maak de verbinding
require '../config.php';


// de dag uit de url halen //
$dagID = $_GET['Dag'];
// haal de naam, id uit de URL
$Naam = $_GET['Naam'];
$taakID = $_GET['id'];
// Klaar uit de url halen //
$klaar = $_GET['Klaar'];

$query = "";


if ($klaar == '0') {
    // query om te updaten
    $query = "UPDATE Taken SET Klaar = '1' WHERE TaakID = {$taakID}";
}

$result = mysqli_query($mysqli, $query);

if($result){
    header("refresh:0; url=dag.php?Naam=" . $Naam . "&Dag=" . $dagID);
}
?>