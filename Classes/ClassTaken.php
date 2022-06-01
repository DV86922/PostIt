<?php /** @noinspection ALL */

class Taken
{
    public $taakID;
    public $gebruikerID;
    public $dagID;
    public $beginTijd;
    public $eindTijd;
    public $taakTitel;
    public $taakOmschrijving;

    public $dagNamen = array(
        1 => "Maandag",
        "Dinsdag",
        "Woensdag",
        "Donderdag",
        "Vrijdag",
        "Zaterdag",
        "Zondag"
    );

    function __construct($taakID, $gebruikerID, $dagID = 0, $beginTijd = 0, $eindTijd = 0, $taakTitel, $taakOmschrijving)
    {
        $this->taakID = $taakID;
        $this->gebruikerID = $gebruikerID;
        $this->dagID = $dagID;
        $this->beginTijd = $beginTijd;
        $this->eindTijd = $eindTijd;
        $this->taakTitel = $taakTitel;
        $this->taakOmschrijving = $taakOmschrijving;
    }

    public function dagNamen(){
        if (!isset($this->dagID)) {
            return "";
        }

        return $this->dagNamen[$this->dagID];
    }
}