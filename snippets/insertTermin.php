<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$gruppe = $_POST['createTerminGruppe'];
$datum = $_POST['createTerminDatum'];
$semester = $_SESSION['jahr'];

$query = "insert into termin(Semester_FK, Gruppe_FK, Datum)
    values('$semester', '$gruppe', '$datum')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection())) {
    $id = mysqli_insert_id($db->getConnection());
    $gruppennummer = mysqli_fetch_all(mysqli_query($db->getConnection(), "select Gruppennummer from gruppe where gruppe.ID='$gruppe'"), MYSQLI_ASSOC);
    echo json_encode(array("id" => $id, "gruppe" => $gruppennummer[0]['Gruppennummer']));
}

$db->close();