<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$gruppenname = $_POST['createGruppeGruppenname'];
$raum = $_POST['createGruppeRaum'];
$semester = $_SESSION['jahr'];
$wochentag = $_POST['createGruppeWochentag'];
$uhrzeit = $_POST['createGruppeUhrzeit'];
$betreuer = $_POST['createGruppeBetreuer'];

$query = "insert into gruppe(Gruppennummer, Semester_FK, Raum, Wochentag, Uhrzeit)
    values('$gruppenname', '$semester', '$raum', '$wochentag', '$uhrzeit')";

mysqli_query($db->getConnection(), $query);

$id = 0;

if(!mysqli_error($db->getConnection()))
    $id = mysqli_insert_id($db->getConnection());

for($i=0; $i < count($betreuer); $i++)
{
    mysqli_query($db->getConnection(), "insert into betreut(Gruppe_FK, Benutzer_FK) values ('$id', '$betreuer[$i]')");
}

$betreuer = mysqli_fetch_all(mysqli_query($db->getConnection(), "select group_concat(concat(Vorname, ' ', Nachname)) `name` from Benutzer join betreut on Benutzer_FK=ID where Gruppe_FK='$id' GROUP BY Gruppe_FK"), MYSQLI_ASSOC);

echo json_encode(array("id" => $id, "betreuer" => $betreuer[0]['name']));

$db->close();