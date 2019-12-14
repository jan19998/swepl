<?php
require_once "dbconnect.php";
$db = new dbconnect();

$gruppenname = $_POST['createGruppeGruppenname'];
$termine = $_POST['createGruppeTermine'];
$raum = $_POST['createGruppeRaum'];
$betreuer = $_POST['createGruppeBetreuer'];
$studenten = $_POST['createGruppeStudenten'];

$query = "insert into gruppe(Gruppennummer)
    values('$gruppenname')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();