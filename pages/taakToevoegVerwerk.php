<?php
// Start session
session_start();
if ($_SESSION['Gebruikersnaam'] && $_SESSION['Wachtwoord']) {
    //maak de verbinding
    require 'pages/config.php';
    require 'Classes/ClassTaken.php';
    require 'Classes/ClassGebruikers.php';

    // Get ingelogde gebruiker
    $user = $_GET['Naam'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Post It!</title>
</head>
<body>
<div>
<?php
require_once "header_responsive.php";

// Maak verbinding
require '../pages/config.php';

//  User uitlezen
$user = $_GET['Naam'];

if (isset($_POST['submit'])) {
// Alle waarden uitgelezen en in een variabele gezet //
    $gebruikerID = $_POST['gebruikerID'];
    $feitje = $_POST['feitje'];
    $antwoord = $_POST['waarnietwaar'];


    $query = "INSERT INTO Feitjes";
    $query .= " (Gebruiker_ID, Feitje, WaarNietWaar)";
    $query .= " VALUES ($gebruikerID, '{$feitje}', '{$antwoord}')";

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        header("refresh:5;url=../index.php?Naam=$user");
    }
}

// Session
} else {
    header("location: login.php");
}