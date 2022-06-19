<?php
require '../config.php';
// zoek uitlezen
$zoek = $_POST['zoek'];
$naamID = $_POST['naamID'];
$dagID = $_POST['dagID'];
$Naam = $_POST['naam'];

// Query controleren of gebruikerID en dagID goed zijn //
$query = "SELECT * FROM Taken WHERE GebruikerID = {$naamID} AND DagID = {$dagID} AND Klaar = '0' ORDER BY BeginTijd";
$result = mysqli_query($mysqli, $query);
if (mysqli_num_rows($result) > 0) {
    while ($item = mysqli_fetch_assoc($result)) {
        // Tijd in de juiste format //
        $TijdBegin = new DateTime($item['BeginTijd']);
        $TijdEind = new DateTime($item['EindTijd']);
        ?>
        <li>
            <div style="background-color: <?= $item['Kleur'] ?>" class="postIt">
                <p class="tijd"><?= $TijdBegin->format('H:i'); ?> - <?= $TijdEind->format('H:i'); ?></p>
                <h2 id="zoekPostIt"><?= $item['TaakTitel'] ?></h2>
                <p id="omschrijving"><?= $item['TaakOmschrijving'] ?></p>
                <p class="pasaan"><a
                            href="../pasaan.php?Naam=<?= $Naam ?>&id=<?= $item['TaakID'] ?>&Dag=<?= $dagID ?>"><i
                                class="fas fa-edit"></i></a></p>
            </div>
        </li>
        <?php
    }
}
?>




