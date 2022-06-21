<?php
// Start session
session_start();
$feedback = "";
if ($_SESSION['Gebruikersnaam'] && $_SESSION['Wachtwoord']) {
    //maak de verbinding
    require 'config.php';
    require '../Classes/ClassTaken.php';
    require '../Classes/ClassGebruikers.php';

    // Get ingelogde gebruiker
    $Naam = $_GET['Naam'];

    header("Refresh:3; url=../index.php?Naam=" . $Naam);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
              integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Post It! - Aan het verwerken...</title>
    </head>
    <body>
    <div>
    <?php
    require_once "header_responsive.php";

    if (isset($_POST['submit'])) {
// Alle waarden uitgelezen en in een variabele gezet //
        $gebruikerID = $_POST['gebruikerID'];
        $BeginTijd = $_POST['beginTijd'];
        $EindTijd = $_POST['eindTijd'];
        $GekozenDag = $_POST['gekozenDag'];
        $TaakTitel = $_POST['taakTitel'];
        $TaakOmschrijving = $_POST['taakOmschrijving'];

        if ($BeginTijd == "" || $BeginTijd == "Geen tijd") {
            $BeginTijd = "NULL";
        }
        if ($EindTijd == "" || $EindTijd == "Geen tijd") {
            $EindTijd = "NULL";
        }
        if ($GekozenDag == "" || $GekozenDag == 8) {
            $GekozenDag = "NULL";
        }

        $toevoegQuery = "INSERT INTO Taken";
        $toevoegQuery .= " (GebruikerID, DagID, BeginTijd, EindTijd, TaakTitel, TaakOmschrijving, Klaar)";
        $toevoegQuery .= " VALUES ($gebruikerID, {$GekozenDag}, '{$BeginTijd}', '{$EindTijd}', '{$TaakTitel}', '{$TaakOmschrijving}', '0')";

        $result = mysqli_query($mysqli, $toevoegQuery);
        if ($result) {
            echo $feedback = "<main><div class='toegevoegd'>
        <h2>Taak toegevoegd!</h2>
        <p>Je wordt over 3 seconden teruggestuurd naar de overzichtspagina. Gebeurt dit niet? <a class='klikHier'
                                                                                                href='../index.php?Naam=$Naam'>Klik
                dan hier</a>.</p>
    </div></main>";
        } else {
            echo $feedback = "<main><div class='toegevoegd'>
<h2>Taak is niet toegevoegd!</h2>
<p>Het toevoegen van de taak is niet gelukt!</p>
<p>Je wordt over 3 seconden teruggestuurd naar de overzichtspagina. Gebeurt dit niet? <a class='klikHier'
                                                                                                href='../index.php?Naam=$Naam'>Klik
                dan hier</a>.</p>
</div></main>";
            echo $toevoegQuery;
        }
    }

// Session
} else {
    header("location: login.php");
}