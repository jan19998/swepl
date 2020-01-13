<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editBetreuerId'];
$benutzer = $_POST['editBetreuerBenutzername'];
$vorname = $_POST['editBetreuerVorname'];
$nachname = $_POST['editBetreuerNachname'];
$email = $_POST['editBetreuerEmail'];
$gruppe = $_POST['editBetreuerGruppe'];

$query = "update benutzer
    set Benutzer='$benutzer', Vorname='$vorname', Nachname='$nachname', `E-Mail`='$email'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$query = "update betreut set Gruppe_FK='$gruppe' where Benutzer_FK='$id'";

mysqli_query($db->getConnection(), $query);

$query = "select Gruppennummer from gruppe where ID='$gruppe'";
$result = mysqli_query($db->getConnection(), $query);
$gruppenname = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($gruppenname[0]['Gruppennummer']);