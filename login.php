<?php
 https://stackoverflow.com/questions/22658141/css-center-form-in-page-horizontally-and-vertically

?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Inloggen</title>
</head>
<body>

<div class="main">
    <?php
     //maak de verbinding
    require 'config.php';
    session_start();
    $bericht = "";

    if(isset($_POST['submit'])){

        // gebruikersnaam een wachtwoord uitlezen
        $gebruikersnaam = $_POST['Gebruikersnaam'];
        $password = $_POST['Wachtwoord'];

        $stmt = $mysqli->prepare("SELECT * FROM Accounts WHERE Gebruikersnaam=? AND Wachtwoord= md5(?)");
        $stmt->bind_param("ss", $gebruikersnaam, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        $rij = mysqli_fetch_array($result);
        if(is_array($rij)){
            $_SESSION['Wachtwoord'] = $rij['Wachtwoord'];
            $_SESSION['Gebruikersnaam'] = $rij['Gebruikersnaam'];
        }
        else{
            $bericht = "Ongeldige gebruikersnaam of wachtwoord";
        }

        if(isset($_SESSION['Gebruikersnaam'], $_SESSION['Wachtwoord'])){
            header("Location:profiel.php?Naam=" . $gebruikersnaam);
        }
    }

    ?>





    <div class="container">
        <form action="" id="login" method="post">
            <div class="bericht"><?php if($bericht !=""){ echo $bericht; }?></div>
            <h2>Login</h2><br>
            <input class="input" type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required><br>
            <input class="input" type="password" name="Wachtwoord" placeholder="Wachtwoord" required>
            <br>
            <div class="center">
                <input class="btn" type="submit" name="submit" value="Verzend">
                <input class="btn" type="reset">
            </div>
        </form>
    </div>
</div>

</body>