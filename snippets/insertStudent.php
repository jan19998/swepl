<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$matrikel = $_POST['createStudentMatrikel'];
$vorname = $_POST['createStudentVorname'];
$nachname = $_POST['createStudentNachname'];
$email = $_POST['createStudentEmail'];
$gruppe = $_POST['createStudentGruppe'];
$semester = $_SESSION['jahr'];

if ($gruppe == "keine")
    $query = "insert into student(Matrikelnummer, Vorname, Nachname, `E-Mail`, Semester_FK)
    values('$matrikel', '$vorname', '$nachname', '$email', '$semester')";
else
    $query = "insert into student(Matrikelnummer, Vorname, Nachname, Gruppe_FK, `E-Mail`, Semester_FK)
    values('$matrikel', '$vorname', '$nachname', '$gruppe', '$email', '$semester')";

mysqli_query($db->getConnection(), $query);

if (!mysqli_error($db->getConnection())) {
    $id = mysqli_insert_id($db->getConnection());
    if($gruppe != "keine") {
        $gruppe = mysqli_fetch_all(mysqli_query($db->getConnection(), "select Gruppennummer from gruppe where ID='$gruppe'"), MYSQLI_ASSOC);
        echo json_encode(array("id" => $id, "gruppe" => $gruppe[0]['Gruppennummer']));
    }else
        echo json_encode(array("id" => $id, "gruppe" => null));
}

$db->close();