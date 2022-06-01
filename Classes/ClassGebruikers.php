<?php
Class Gebruiker{
    public $gebruikerID;
    public $gebruikersnaam;
    protected $wachtwoord;
    public $email;

    function __construct($gebruikerID, $gebruikersnaam, $wachtwoord, $email)
    {
        $this->gebruikerID = $gebruikerID;
        $this->gebruikersnaam = $gebruikersnaam;
        $this->wachtwoord = $wachtwoord;
        $this->email = $email;
    }

}