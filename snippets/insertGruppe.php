<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$gruppenname = $_POST['createGruppeGruppenname'];
$termine = $_POST['createGruppeTermine'];
$raum = $_POST['createGruppeRaum'];
$betreuer = $_POST['createGruppeBetreuer'];
$studenten = $_POST['createGruppeStudenten'];
$semester = $_SESSION['jahr'];

$query = "insert into gruppe(Gruppennummer, Semester_FK)
    values('$gruppenname', '$semester')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();