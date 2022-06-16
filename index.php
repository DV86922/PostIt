<?php
// Start session
session_start();
if ($_SESSION['Gebruikersnaam'] && $_SESSION['Wachtwoord']) {
    //maak de verbinding
    require 'pages/config.php';
    require 'Classes/ClassTaken.php';
    require 'Classes/ClassGebruikers.php';

    // Get ingelogde gebruiker
    $Naam = $_GET['Naam'];
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
        <link rel="stylesheet" href="css/style.css">
        <title>Post It!</title>
    </head>
    <body>
    <div>
        <!--  Header  -->
        <?php
        $bericht = "";

        if (isset($_POST['pasaanSubmit'])) {
            $gebruikerID = $_POST['gebruikerID'];
            $gebruikersnaam = $_POST['gebruikersnaam'];
            $wachtwoord = $_POST['wachtwoord'];
            $email = $_POST['email'];

            $query = "UPDATE Accounts SET Gebruikersnaam = '{$gebruikersnaam}', ";
            $query .= " Wachtwoord = md5('{$wachtwoord}'), Email = '{$email}'";
            $query .= " WHERE GebruikerID = {$gebruikerID}";

            $result = mysqli_query($mysqli, $query);


            if ($result) {
                header("Location:profiel.php?Naam=" . $gebruikersnaam);
            }
        }
        ?>

        <aside class="instellingen">
            <h4><i class="fas fa-cog"></i></h4>
            <div class="tekst">

                <form action="" id="instelling" method="post">
                    <?php
                    // Query aan gemaakt //
                    $query = "SELECT * FROM `Accounts` WHERE Gebruikersnaam = '{$Naam}'";
                    // De query uitgevoerd en het resultaat opgevangen //
                    $result = mysqli_query($mysqli, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($item = mysqli_fetch_assoc($result)) {
                            ?>
                            <input hidden type="text" name="gebruikerID"
                                   value="<?= $item['GebruikerID'] ?>">
                            <p><strong>Gebruikersnaam: </strong><input class="input" type="text"
                                                                       name="gebruikersnaam"
                                                                       value="<?= $item['Gebruikersnaam'] ?>"
                                                                       disabled></p>
                            <p><strong>Wachtwoord:</strong><input class="input" type="password"
                                                                  name="wachtwoord" placeholder="******"
                                                                  disabled></p>
                            <p><strong>E-mail: </strong><input class="input" type="email" name="email"
                                                               value="<?= $item['Email'] ?>" disabled></p>
                            <?php
                        }
                    }
                    ?>
                    <label id="pasaan" for="button"><i class="fas fa-sliders-h"></i></label>
                    <input type="button" name="edit" id="button" onclick="enableInput()" hidden>
                    <p id="bevestiging">
                        <label for="check"><i class="fas fa-check-circle"></i></label>
                        <input type="submit" id="check" name="pasaanSubmit" hidden>
                    </p>
                </form>
            </div>
        </aside>

        <header class="header">
            <div class="logo">
                <a href="#"><img src="media/logo.png" alt="Post It!-logo" class="logo-img"></a>
            </div>

            <nav class="nav-md">
                <ul class="menu-nav">
                    <li class="menu-nav__item active">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=1" class="menu-nav__link" id="ma">Maandag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=2" class="menu-nav__link" id="di">Dinsdag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=3" class="menu-nav__link" id="wo">Woensdag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=4" class="menu-nav__link" id="do">Donderdag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=5" class="menu-nav__link" id="vrij">Vrijdag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=6" class="menu-nav__link" id="zat">Zaterdag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=7" class="menu-nav__link" id="zon">Zondag</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/loguit.php?Naam=<?= $Naam ?>" class="menu-nav__link" id="loguit">Log uit</a>
                    </li>
                </ul>
            </nav>

            <nav class="nav-sm">
                <ul class="menu-nav">
                    <li class="menu-nav__item active">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=1" class="menu-nav__link" id="ma">Ma</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=2" class="menu-nav__link" id="di">Di</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=3" class="menu-nav__link" id="wo">Wo</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=4" class="menu-nav__link" id="do">Do</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=5" class="menu-nav__link" id="vrij">Vr</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=6" class="menu-nav__link" id="zat">Za</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/dagen/dag.php?Naam=<?= $Naam ?>&Dag=7" class="menu-nav__link" id="zon">Zo</a>
                    </li>
                    <li class="menu-nav__item">
                        <a href="pages/loguit.php?Naam=<?= $Naam ?>" class="menu-nav__link" id="loguit">Log uit</a>
                    </li>
                </ul>
            </nav>
        </header>
        <!--  Header  -->

        <?php
        // Query voor taken
        $ITPtakenQuery = "SELECT * FROM Taken LEFT JOIN Accounts ON Taken.GebruikerID = Accounts.GebruikerID WHERE Gebruikersnaam = '{$Naam}' AND DagID IS NULL;";
        $takenQuery = "SELECT * FROM Taken LEFT JOIN Accounts ON Taken.GebruikerID = Accounts.GebruikerID WHERE Gebruikersnaam = '{$Naam}' AND DagID IS NOT NULL;";
        $ITPtakenResult = mysqli_query($mysqli, $ITPtakenQuery);
        $takenResult = mysqli_query($mysqli, $takenQuery);

        $ITPtakenArr = array();
        $takenArr = array();
        // Result voor feitjes andere gebruikers
        if (mysqli_num_rows($takenResult) > 0) {
            while ($item = mysqli_fetch_assoc($ITPtakenResult)) {
                $ITPnewTaak = new Taken($item['taakID'], $item['gebruikerID'], $item['dagID'], $item['BeginTijd'], $item['EindTijd'], $item['TaakTitel'], $item['TaakOmschrijving']);

                $ITPtakenArr[] = $ITPnewTaak;
            }
            while ($item = mysqli_fetch_assoc($takenResult)) {
                $newTaak = new Taken($item['taakID'], $item['gebruikerID'], $item['dagID'], $item['BeginTijd'], $item['EindTijd'], $item['TaakTitel'], $item['TaakOmschrijving']);
                $takenArr[] = $newTaak;
            }
        }

//                echo "<pre>";
//        var_dump($newTaak);
//        echo "</pre>";
//        echo "<pre>";
//        var_dump($ITPtakenArr);
//        echo "</pre>";

        ?>
        <main>
            <div>
                <!--        Taak toevoegen  -->
                <div>
                    <a href="pages/taakToevoeg.php?Naam=<?= $Naam ?>"><i class="fas fa-plus"> Taak toevoegen</i></a>
                </div>

                <!--        Zoekbalk  -->

            </div>
            <!--        Nog in te plannen taken  -->
            <div class="ITPTaken">
                <h3 id="demo">Nog in te plannen taken:</h3>
                <?php

                if (isset($_POST['toepasSubmit'])) {
                    $ITPtaakID = $_POST['ITPtaakID'];
                    $ITPdag = $_POST['gekozenDag'];
                    $ITPbeginTijd = $_POST['ITPbeginTijd'];
                    $ITPeindTijdd = $_POST['ITPeindTijd'];
                    $ITPtaakTitel = $_POST['ITPtaakTitel'];
                    $ITPtaakOmschrijving = $_POST['ITPtaakOmschrijving'];

                    $query = "UPDATE Taken SET";
                    $query .= " DagID = {$ITPdag}, BeginTijd = '{$ITPbeginTijd}', EindTijd = '{$ITPeindTijdd}',";
                    $query .= " TaakTitel = '{$ITPtaakTitel}', TaakOmschrijving = '{$ITPtaakOmschrijving}'";
                    $query .= " WHERE TaakID = {$ITPtaakID}";

                    $result = mysqli_query($mysqli, $query);


                    if ($result) {
                        header("Location:profiel.php?Naam=" . $gebruikersnaam);
                    }
                }


                foreach ($ITPtakenArr as $ITPtaakItem) {
                    ?>
                    <div class="ITPTaakBox">
                        <form class="ITPTaak" name="ITPTaak" action="" method="POST">
                            <input type="hidden" name="ITPtaakID" value="<?= $ITPtaakItem->taakID ?>">
                            <input name="ITPtaakTitel" value="<?= $ITPtaakItem->taakTitel ?>">
                            <input name="ITPtaakOmschrijving" value="<?= $ITPtaakItem->taakOmschrijving ?>">
                            <select name="ITPbeginTijd">
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
                            <select name="ITPeindTijd">
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

                            <select name="gekozenDag">
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
                            <input type="submit" id="check" name="toepasSubmit">
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>

            <!--        Taken overzicht  -->
            <div class="takenOverzicht">
                <h3>Taken</h3>
                <?php
                foreach ($takenArr as $taakItem) {
                    // code neerzetten voor dagen
                    ?>
                    <div class="zichtTaakBox">
                        <div class="zichtTaak">
                            <p><?= $taakItem->taakTitel ?></p>
                            <p><?= $taakItem->taakOmschrijving ?></p>

                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </main>

        <footer>
        </footer>
    </div>

    <script>
        // Functie voor reservering wijzigen

        function enableInput() {
            document.querySelectorAll('input').forEach(element => element.disabled = false);

            document.getElementById('bevestiging').style.display = "inline-block";
        }
    </script>
    </body>
    </html>
    <?php
} else {
    header("location: pages/login.php");
}