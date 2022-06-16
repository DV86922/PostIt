<?php
require 'config.php';
session_start();
$bericht = "";

// haal de naam en dag uit de URL
$Naam = $_GET['Naam'];
$dagID = $_GET['Dag'];

if(isset($_POST['verzend'])) {
    // Hier worden dan ook alles velden weer uitgelezen en in een variabele gestopt.
    $id = $_POST['id'];
    $BeginTijd = $_POST['BeginTijd'];
    $EindTijd = $_POST['EindTijd'];
    $TaakTitel = $_POST['TaakTitel'];
    $TaakOmschrijving = $_POST['TaakOmschrijving'];

    // Even controleren of er geen één variabele leeg is, anders wordt de if uitgevoerd //
    if ($BeginTijd == "" || $EindTijd == "" || $TaakTitel == "" || $TaakOmschrijving == "") {
        $bericht =  "Niet alle velden zijn ingevuld.";
    } else {
        // Ik heb een aanpas query aangemaakt //
        $query = "UPDATE Taken";
        $query .= " SET BeginTijd = '{$BeginTijd}', EindTijd = '{$EindTijd}', TaakTitel = '{$TaakTitel}', TaakOmschrijving = '{$TaakOmschrijving}'";
        $query .= " WHERE TaakID = {$id}";

        $result = mysqli_query($mysqli, $query);
        // Controleren of het resultaat is gelukt //
        if ($result) {
            header("Location: dagen/dag.php?Naam=$Naam&Dag=$dagID");

        }
        else{
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
    <title>Pas aan</title>
</head>
<body>
<br>
<h1>Pas aan</h1>
<?php

// Het ID uitlezen //
$id = $_GET['id'];

$query = "SELECT * FROM Taken WHERE TaakID = " . $id;

$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $item = mysqli_fetch_assoc($result);
    ?>
    <ul>
        <li>
            <form class="update" name="updateFormulier" method="post" action="">
                <div><?php if ($bericht != "") { echo $bericht;} ?></div>
                <div class="postIt formPost">
                    <input type="hidden" name="id" value="<?= $item['TaakID']; ?>">
                    <p class="tijd">
                        <input class="tijdInput" type="text" name="BeginTijd" required value="<?= $item['BeginTijd'] ?>"> -
                        <input class="tijdInput" type="text" name="EindTijd" required value="<?= $item['EindTijd'] ?>">
                    </p>
                    <h2><input class="taakTitel" type="text" name="TaakTitel" required value="<?= $item['TaakTitel'] ?>"></h2>
                    <input class="omschrijvingInput" type="text" name="TaakOmschrijving" required value="<?= $item['TaakOmschrijving'] ?>">
                    <input class="btn" type="submit" name="verzend" value="Aanpassen">
                </div>
            </form>
        </li>
    </ul>

    <?php
}
?>

</body>
</html>
