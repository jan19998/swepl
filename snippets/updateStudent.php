<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editStudentId'];
$matrikel = $_POST['editStudentMatrikel'];
$vorname = $_POST['editStudentVorname'];
$nachname = $_POST['editStudentNachname'];
$email = $_POST['editStudentEmail'];
$gruppe = $_POST['editStudentGruppe'];

$query = "update student
    set Matrikelnummer='$matrikel', Vorname='$vorname', Nachname='$nachname', Gruppe_FK ='$gruppe', `E-Mail`='$email'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();