<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;

$result = mysqli_query($db->getConnection(), "Select student.ID id, Matrikelnummer matrikelnummer,
        Nachname nachname, Vorname vorname, gruppe.Gruppennummer gruppe, `E-Mail` email
        from student
        left JOIN gruppe ON student.Gruppe_FK=gruppe.ID
        where student.Semester_FK='$jahr' order by Matrikelnummer");
$studenten = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();

echo json_encode($studenten);