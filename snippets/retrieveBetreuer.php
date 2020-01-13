<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;

$query = "Select benutzer.ID id, Nachname nachname, Vorname vorname, `E-Mail` email, Benutzer benutzername, gruppe.Gruppennummer gruppe
    from benutzer
    left join betreut on betreut.Benutzer_FK=benutzer.ID
    left join gruppe on betreut.Gruppe_FK=gruppe.ID
    where IstDozent=0 and benutzer.Semester_FK='$jahr'";
$result = mysqli_query($db->getConnection(), $query);
$betreuer = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($betreuer);