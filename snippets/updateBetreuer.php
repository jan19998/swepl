<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editBetreuerId'];
$benutzer = $_POST['editBetreuerBenutzername'];
$vorname = $_POST['editBetreuerVorname'];
$nachname = $_POST['editBetreuerNachname'];
$email = $_POST['editBetreuerEmail'];

$query = "update benutzer
    set Benutzer='$benutzer', Vorname='$vorname', Nachname='$nachname', `E-Mail`='$email'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();