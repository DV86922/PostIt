<?php
require 'config.php';
session_start();
$bericht = "";

// haal de naam en dag uit de URL
$Naam = $_GET['Naam'];
$dagID = $_GET['Dag'];

if (isset($_POST['verzend'])) {
    // Hier worden dan ook alles velden weer uitgelezen en in een variabele gestopt.
    $id = $_POST['id'];
    $BeginTijd = $_POST['BeginTijd'];
    $EindTijd = $_POST['EindTijd'];
    $GekozenDag = $_POST['GekozenDag'];
    $TaakTitel = $_POST['TaakTitel'];
    $TaakOmschrijving = $_POST['TaakOmschrijving'];
    $kleur = $_POST['kleur'];
//    var_dump($BeginTijd);
    if($BeginTijd == ""){
        $BeginTijd = "NULL";
    }
    if($EindTijd == ""){
        $EindTijd = "NULL";
    }
    if($GekozenDag == ""){
        $GekozenDag = "NULL";
    }
    if($kleur == ""){
        $kleur = "lightyellow";
    }

    // Veranderen in getal
    $TaakID = intval($id);
    $gekozenDagID = intval($GekozenDag);

// $BeginTijd == "" || $EindTijd == "" || $GekozenDag == "" || -  || $kleur == ""
    // Even controleren of er geen één variabele leeg is, anders wordt de if uitgevoerd //
    if ($TaakTitel == "" || $TaakOmschrijving == "") {
        $bericht = "Niet alle velden zijn ingevuld.";
    } else {
        // Ik heb een aanpas query aangemaakt //
        $query = "UPDATE Taken";
        $query .= " SET DagID = {$gekozenDagID}, BeginTijd = '{$BeginTijd}', EindTijd = '{$EindTijd}', TaakTitel = '{$TaakTitel}', TaakOmschrijving = '{$TaakOmschrijving}', Kleur= '{$kleur}'";
        $query .= " WHERE TaakID = {$TaakID}";

        $result = mysqli_query($mysqli, $query);

        // Controleren of het resultaat is gelukt //
        if ($result) {
            header("Location: dagen/dag.php?Naam=$Naam&Dag=$dagID");

        } else {
            var_dump($query);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="dagen/ajax.js" defer></script>
    <title>Pas aan</title>
</head>
<body>
<?php
require_once "header_responsive.php";
?>
<br>
<h1 style="text-align: center">Pas aan</h1>
<div class="dagen">
    <?php
    // Het ID uitlezen //
    $id = $_GET['id'];

    $query = "SELECT * FROM Taken WHERE TaakID = " . $id;

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)){

        $taakTitel = $item['TaakTitel'];
        $taakOmschrijving = $item['TaakOmschrijving'];
        $beginTijd = $item['BeginTijd'];
        $eindTijd = $item['EindTijd'];
        $dagInData = $item['DagID'];

        // TEST \\
//        echo "<pre>";
//        var_dump($beginTijd);
//        echo "</pre>";
//        echo "<pre>";
//        var_dump($eindTijd);
//        echo "</pre>";
//        echo "<pre>";
//        var_dump($dagInData);
//        echo "</pre>";
        ?>
        <ul>
            <li>
                <form class="update" name="updateFormulier" method="post" action="">
                    <div><?php if ($bericht != "") {
                            echo $bericht;
                        } ?></div>
                    <div class="postIt formPost">
                        <input type="hidden" name="id" value="<?= $item['TaakID']; ?>">
                        <div class="tijd">
                            <select name="BeginTijd">
<!--                                <option disabled selected>Begintijd</option>-->
                                <?php
                                // Query voor tijden
                                $tijdQuery = "SELECT * FROM Tijden";
                                $tijdResult = mysqli_query($mysqli, $tijdQuery);

                                if (mysqli_num_rows($tijdResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($tijdResult)) {
                                        $tijd = $item["Tijden"];
                                        ?>
<!--                                        <option value="--><?php //echo $tijd ?><!--">--><?//= $tijd ?><!--</option>-->
                                <?php

                                        // Selecteer de tijd van de database
                                        if ($beginTijd == $tijd) {
                                            echo "<option value='". $tijd ."' selected>". $tijd ."</option>";
                                        }
                                        // Vul de rest van de tijden aan, als je dit uitcomment -->
                                        else {
                                            echo "<option value='". $tijd ."'>". $tijd ."</option>";
                                        }
                                        // <-- Dan komt de overige data (tijden + dagen) niet tevoorschijn
                                    }
                                }
                                ?>
                            </select>
                            <select name="EindTijd">
<!--                                <option disabled selected>Eindtijd</option>-->
                                <?php
                                $tijdResult = mysqli_query($mysqli, $tijdQuery);
                                if (mysqli_num_rows($tijdResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($tijdResult)) {
                                        $tijd = $item["Tijden"];

                                        // Selecteer de tijd van de database
                                        if ($eindTijd == $tijd) {
                                            echo "<option value='". $tijd ."' selected>". $tijd ."</option>";
                                        } else {
                                            // Vul de rest van de tijden aan
                                            echo "<option value='". $tijd ."'>". $tijd ."</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <select name="GekozenDag">
<!--                                <option disabled selected>Dag</option>-->
                                <?php
                                // Query voor tijden
                                $dagQuery = "SELECT * FROM Dagen";
                                $dagResult = mysqli_query($mysqli, $dagQuery);

                                if (mysqli_num_rows($dagResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($dagResult)) {
                                        $dagID = $item["DagID"];
                                        $dag =  $item["Dagen"];

                                        // Selecteer de tijd van de database
                                        if ($dagInData == $dagID) {
                                            echo "<option value='". $dagID ."' selected>". $dag ."</option>";
                                        } else {
                                            // Vul de rest van de dagen aan
                                            echo "<option value='". $dagID ."'>". $dag ."</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kleur">
                            <input hidden type="radio" name="kleur" id="lichtRoodPostIt" value="lightcoral"><label
                                class="knop lichtRood" for="lichtRoodPostIt"></label>
                            <input hidden type="radio" name="kleur" id="lichtGeelPostIt" value="lightyellow"><label
                                class="knop lichtGeel" for="lichtGeelPostIt"></label>
                            <input hidden type="radio" name="kleur" id="lichtBlauwPostIt" value="lightblue"><label
                                class="knop lichtBlauw" for="lichtBlauwPostIt"></label>
                            <input hidden type="radio" name="kleur" id="lichtGroenPostIt" value="lightgreen"> <label
                                class="knop lichtGroen" for="lichtGroenPostIt"></label>
                        </div>

                        <h2><input class="taakTitel" type="text" name="TaakTitel" required
                                   value="<?= $taakTitel ?>"></h2>
                        <input class="omschrijvingInput" type="text" name="TaakOmschrijving" required
                               value="<?= $taakOmschrijving ?>">
                        <input class="btn" type="submit" name="verzend" value="Aanpassen">
                    </div>
                </form>
            </li>
        </ul>

        <?php
        }
    }
    ?>
</div>
</body>
</html>