<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$gruppenname = $_POST['createGruppeGruppenname'];
$raum = $_POST['createGruppeRaum'];
$semester = $_SESSION['jahr'];
$wochentag = $_POST['createGruppeWochentag'];
$uhrzeit = $_POST['createGruppeUhrzeit'];

$query = "insert into gruppe(Gruppennummer, Semester_FK, Raum, Wochentag, Uhrzeit)
    values('$gruppenname', '$semester', '$raum', '$wochentag', '$uhrzeit')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();