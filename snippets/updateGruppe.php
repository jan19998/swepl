<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editGruppeId'];
$gruppenname = $_POST['editGruppeGruppenname'];
$raum = $_POST['editGruppeRaum'];
$wochentag = $_POST['editGruppeWochentag'];
$uhrzeit = $_POST['editGruppeUhrzeit'];

$query = "update gruppe
    set Gruppennummer='$gruppenname', Raum='$raum', Wochentag='$wochentag', Uhrzeit='$uhrzeit'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();