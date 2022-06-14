<?php

session_start();
unset($_SESSION["Gebruikersnaam"]);
unset($_SESSION["Wachtwoord"]);
unset($_SESSION["Email"]);
header("Location:login.php");

