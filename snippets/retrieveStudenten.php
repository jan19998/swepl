<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;

$result = mysqli_query($db->getConnection(), "Select ID id, Matrikelnummer matrikelnummer, Nachname nachname, Vorname vorname, Gruppe_FK gruppe, `E-Mail` email
    from student where Semester_FK='$jahr' order by Matrikelnummer");
$studenten = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();

echo json_encode($studenten);