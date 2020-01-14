<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editStudentId'];
$matrikel = $_POST['editStudentMatrikel'];
$vorname = $_POST['editStudentVorname'];
$nachname = $_POST['editStudentNachname'];
$email = $_POST['editStudentEmail'];
$gruppe = $_POST['editStudentGruppe'];

if ($gruppe != "keine")
    $query = "update student
    set Matrikelnummer='$matrikel', Vorname='$vorname', Nachname='$nachname', Gruppe_FK ='$gruppe', `E-Mail`='$email'
    where ID='$id'";
else
    $query = "update student
    set Matrikelnummer='$matrikel', Vorname='$vorname', Nachname='$nachname', `E-Mail`='$email', Gruppe_FK=null
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

if ($gruppe != "keine") {
    $query = "select Gruppennummer from gruppe where ID='$gruppe'";
    $result = mysqli_query($db->getConnection(), $query);
    $gruppenname = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($gruppenname[0]['Gruppennummer']);
}else
    echo json_encode(null);

$db->close();

