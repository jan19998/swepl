<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editGruppeId'];
$gruppenname = $_POST['editGruppeGruppenname'];
$raum = $_POST['editGruppeRaum'];
$wochentag = $_POST['editGruppeWochentag'];
$uhrzeit = $_POST['editGruppeUhrzeit'];
$betreuer = $_POST['editGruppeBetreuer'];

$query = "update gruppe
    set Gruppennummer='$gruppenname', Raum='$raum', Wochentag='$wochentag', Uhrzeit='$uhrzeit'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

mysqli_query($db->getConnection(), "delete from betreut where Gruppe_FK='$id'");

for ($i = 0; $i < count($betreuer); $i++) {
    mysqli_query($db->getConnection(), "insert into betreut(Gruppe_FK, Benutzer_FK) values('$id', '$betreuer[$i]')");
}

$b = mysqli_fetch_assoc(mysqli_query($db->getConnection(), "select group_concat(concat(Vorname, ' ', Nachname)) `name` from Benutzer join betreut on Benutzer_FK=Benutzer.ID where Gruppe_FK='$id' GROUP BY Gruppe_FK"));

$db->close();

echo json_encode($b['name']);