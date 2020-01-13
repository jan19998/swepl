<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editGruppeId'];
$gruppenname = $_POST['editGruppeGruppenname'];
$raum = $_POST['editGruppeRaum'];

$query = "update gruppe
    set Gruppennummer='$gruppenname', Raum='$raum'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();