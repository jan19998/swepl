<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editGruppeId'];
$gruppenname = $_POST['editGruppeGruppenname'];
$termine = $_POST['editGruppeTermine'];
$raum = $_POST['editGruppeRaum'];
$studenten = $_POST['editGruppeStudenten'];
$betreuer = $_POST['editGruppeBetreuer'];

$query = "update gruppe
    set Gruppennummer='$gruppenname', Raum='$raum'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();