<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Inschrijven</title>
</head>
<body>

<div class="main">
    <?php
    // De verbinding toevoegen //
    require 'config.php';

    $bericht = "";

    if (isset($_POST['inschrijving'])) {
        // De gebruikersnaam, wachtwoord en email uitlezen //
        $gebruikersnaam = $_POST['Gebruikersnaam'];
        $wachtwoord = $_POST['Wachtwoord'];
        $email = $_POST['Email'];

        // Controleren of de variabelen niet leeg zijn //
        if ($gebruikersnaam == "" || $wachtwoord == "" || $email == "") {
            $bericht = "Niet alle velden zijn ingevuld.";

        } // Anders de query invoeren om die variabelen in te vullen in de database //
        else {
            // Controleren of de gebruikersnaam al bestaat //
            $sql = "SELECT * FROM Accounts WHERE Gebruikersnaam='" . $gebruikersnaam . "'";
            $result = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($result) > 0) {
                $bericht = "Dit gebruikersnaam bestaat al!";
            } else {
                // Controleren of de email al bestaat //
                $sql = "SELECT * FROM Accounts WHERE Email='" . $email . "'";
                $result = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $bericht = "Dit email bestaat al!";
                } else {
                    // het wordt toegevoegd aan de tabel //
                    $query = "INSERT INTO Accounts";
                    $query .= " (Gebruikersnaam, Wachtwoord, Email)";
                    $query .= " VALUES ('{$gebruikersnaam}', md5('{$wachtwoord}'), '{$email}')";
                }
            }
        }

        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo "Registratie gelukt!";
            header("Location:login.php");
        }

    }

    ?>
    <div class="container">
        <form id="inschrijf" name="inschrijven" method="post" action="">
            <div class="bericht"><?php if ($bericht != "") {
                    echo $bericht;
                } ?></div>
            <h2>Inschrijven</h2><br>
            <label>Gebruikersnaam:</label>
            <input class="input" type="text" name="Gebruikersnaam" placeholder="JaneDoe" required><br>
            <label>Wachtwoord:</label>
            <input class="input" type="password" name="Wachtwoord" placeholder="••••••••" required><br>
            <label>E-mail:</label>
            <input class="input" type="email" name="Email" placeholder="12345@glr.nl" required><br>

            <br>
            <div class="center">
                <input class="btn" type="submit" name="inschrijving" value="Verzend">
                <input class="btn" type="reset">
            </div>
        </form>
    </div>
</div>

</body>