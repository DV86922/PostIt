<?php
// Start session
session_start();
if ($_SESSION['Gebruikersnaam'] && $_SESSION['Wachtwoord']) {
//maak de verbinding
    require 'config.php';
    require '../Classes/ClassGebruikers.php';

// Get ingelogde gebruiker
    $Naam = $_GET['Naam'];
    $inGebruiker = "";

// Query voor user
    $userQuery = "SELECT * FROM Accounts WHERE Gebruikersnaam = '{$Naam}'";
    $userResult = mysqli_query($mysqli, $userQuery);

    if (mysqli_num_rows($userResult) > 0) {
        while ($item = mysqli_fetch_assoc($userResult)) {
            $inGebruiker = new Gebruiker($item['GebruikerID'], $item['Gebruikersnaam'], $item['Wachtwoord'], $item['Email']);
        }
    }
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
        <title>Post It! - Taak toevoegen</title>
    </head>
    <body>
    <?php
    require_once "header_responsive.php";
    ?>

    <main class="taakToevoegP">
        <div class="dagen">
            <!--        Taak toevoegen  -->
            <div class="titelToevoeg">
                <h1>Taak toevoegen</h1>
            </div>

            <div>
                <ul>
                    <li>
                        <form class="taakToevoeg" name="toevoegForm" method="post"
                              action="taakToevoegVerwerk.php?Naam=<?php echo $Naam; ?>">
                            <input type="hidden" name="gebruikerID" value="<?php echo $inGebruiker->gebruikerID ?>">
                            <div class="postIt formPost">
                                <div class="tijd">
                                    <select name="beginTijd">
                                        <option disabled selected>Begintijd</option>
                                        <?php
                                        // Query voor tijden
                                        $tijdQuery = "SELECT * FROM Tijden";
                                        $tijdResult = mysqli_query($mysqli, $tijdQuery);

                                        if (mysqli_num_rows($tijdResult) > 0) {
                                            while ($item = mysqli_fetch_assoc($tijdResult)) {
                                                $tijd = $item["Tijden"];

                                                if ($tijd == "00:00:00") {
                                                    $tijd = "Geen tijd";
                                                }
                                                ?>
                                                <option value="<?php echo $tijd ?>"><?= $tijd ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select name="eindTijd">
                                        <option disabled selected>Eindtijd</option>
                                        <?php
                                        // Query voor tijden
                                        $tijdQuery = "SELECT * FROM Tijden";
                                        $tijdResult = mysqli_query($mysqli, $tijdQuery);
                                        if (mysqli_num_rows($tijdResult) > 0) {
                                            while ($item = mysqli_fetch_assoc($tijdResult)) {
                                                $tijd = $item["Tijden"];

                                                if ($tijd == "00:00:00") {
                                                    $tijd = "Geen tijd";
                                                }
                                                ?>
                                                <option value="<?php echo $tijd ?>"><?= $tijd ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select name="gekozenDag" class="gekozenDag">
                                        <option disabled selected>Dag</option>
                                        <?php
                                        // Query voor tijden
                                        $dagQuery = "SELECT * FROM Dagen";
                                        $dagResult = mysqli_query($mysqli, $dagQuery);

                                        if (mysqli_num_rows($dagResult) > 0) {
                                            while ($item = mysqli_fetch_assoc($dagResult)) {
                                                $dagID = $item["DagID"];
                                                $dag = $item["Dagen"];
                                                ?>
                                                <option value="<?php echo $dagID ?>"><?= $dag ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <h2><input class="taakTitel" type="text" name="taakTitel" required
                                           placeholder="Taak titel"></h2>
                                <input class="omschrijvingInput" type="text" name="taakOmschrijving" required
                                       placeholder="Taak omschrijving">
                                <input class="btn" type="submit" name="submit" value="Toevoegen">
                            </div>
                        </form>
                    </li>
                </ul>

            </div>
        </div>
    </main>
    </body>
    </html>
    <?php
// Session
} else {
    header("location: login.php");
}