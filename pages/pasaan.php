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

    // Even controleren of er geen één variabele leeg is, anders wordt de if uitgevoerd //
    if ($BeginTijd == "" || $EindTijd == "" || $GekozenDag == "" || $TaakTitel == "" || $TaakOmschrijving == "" || $kleur == "") {
        $bericht = "Niet alle velden zijn ingevuld.";
    } else {
        // Ik heb een aanpas query aangemaakt //
        $query = "UPDATE Taken";
        $query .= " SET DagID = {$dagID} BeginTijd = '{$BeginTijd}', EindTijd = '{$EindTijd}', TaakTitel = '{$TaakTitel}', TaakOmschrijving = '{$TaakOmschrijving}', Kleur= '{$kleur}'";
        $query .= " WHERE TaakID = {$id}";

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
<br>
<h1>Pas aan</h1>
<div class="dagen">
    <?php
    // Het ID uitlezen //
    $id = $_GET['id'];

    $query = "SELECT * FROM Taken WHERE TaakID = " . $id;

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);

        $taakTitel = $item['TaakTitel'];
        $taakOmschrijving = $item['TaakOmschrijving'];
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
                                <option disabled selected>Begintijd</option>
                                <?php
                                // Query voor tijden
                                $tijdQuery = "SELECT * FROM Tijden";
                                $tijdResult = mysqli_query($mysqli, $tijdQuery);

                                if (mysqli_num_rows($tijdResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($tijdResult)) {
                                        $tijd = $item["Tijden"];
                                        ?>
                                        <option value="<?php echo $tijd ?>"><?= $tijd ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <select name="EindTijd">
                                <option disabled selected>Eindtijd</option>
                                <?php
                                $tijdResult = mysqli_query($mysqli, $tijdQuery);
                                if (mysqli_num_rows($tijdResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($tijdResult)) {
                                        $tijd = $item["Tijden"];
                                        ?>
                                        <option value="<?php echo $tijd ?>"><?= $tijd ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <select name="GekozenDag">
                                <option disabled selected>Dag</option>
                                <?php
                                // Query voor tijden
                                $dagQuery = "SELECT * FROM Dagen";
                                $dagResult = mysqli_query($mysqli, $dagQuery);

                                if (mysqli_num_rows($dagResult) > 0) {
                                    while ($item = mysqli_fetch_assoc($dagResult)) {
                                        $dagID = $item["DagID"];
                                        $dag =  $item["Dagen"];
                                        ?>
                                        <option value="<?php echo $dagID ?>"><?= $dag ?></option>
                                        <?php
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
    ?>
</div>
</body>
</html>
