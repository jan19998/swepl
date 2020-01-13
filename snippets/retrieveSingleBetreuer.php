<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select benutzer.ID, Benutzer, Vorname, Nachname, `E-Mail`, Gruppennummer
    from benutzer
    left join betreut on betreut.Benutzer_FK=benutzer.ID
    left join gruppe on betreut.Gruppe_FK=gruppe.ID
    where benutzer.ID='$id'");
$betreuer = mysqli_fetch_assoc($result);

echo json_encode($betreuer);

$db->close();