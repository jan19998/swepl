<?php
require_once "dbconnect.php";
$db = new dbconnect();

$matrikel = $_POST['createStudentMatrikel'];
$vorname = $_POST['createStudentVorname'];
$nachname = $_POST['createStudentNachname'];
$email = $_POST['createStudentEmail'];
$gruppe = $_POST['createStudentGruppe'];

$query = "insert into student(Matrikelnummer, Vorname, Nachname, Gruppe_FK, `E-Mail`)
    values('$matrikel', '$vorname', '$nachname', '$gruppe', '$email')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();