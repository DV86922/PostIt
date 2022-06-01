<?php


// maak foutmeldingen zichtbaar op elke pagina
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// maak de inlog gegevens
$db_hostname = "localhost";
$db_username = "feitjes";
$db_password = "#1Geheim";
$db_database = "feitjes";

// maak een connectie met de database
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// test de connectie met de database
if (!$mysqli) {
    echo "FOUT: Er is geen connectie met de database. <br>";
    echo "ERROR " . mysqli_connect_error() . "<br>";
    exit;
}
// else{
// haal de else statement uit de ocde als er wel een verbinding is
// echo "Er is een verbinding met de database " . $db_database . "gemaakt. <br>";
// }

