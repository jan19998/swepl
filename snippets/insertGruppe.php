<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$gruppenname = $_POST['createGruppeGruppenname'];
$raum = $_POST['createGruppeRaum'];
$semester = $_SESSION['jahr'];

$query = "insert into gruppe(Gruppennummer, Semester_FK, Raum)
    values('$gruppenname', '$semester', '$raum')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();