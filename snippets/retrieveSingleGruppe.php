<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select gruppe.ID, Raum, Uhrzeit, Gruppennummer, Wochentag, GROUP_CONCAT(CONCAT(Vorname, ' ', Nachname)) `name`
    from gruppe
    left JOIN betreut ON Gruppe_FK=gruppe.ID
    left JOIN Benutzer ON Benutzer_FK=Benutzer.ID
    where gruppe.ID='$id'
    GROUP BY gruppe.ID");
$gruppe = mysqli_fetch_assoc($result);

echo json_encode($gruppe);

$db->close();