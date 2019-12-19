<?php
require_once "dbconnect.php";
$db = new dbconnect();

$meilenstein = $_POST['createMeilenstein'];
$frist = $_POST['createMeilensteinFrist'];
$beschreibung = $_POST['createMeilensteinBeschreibung'];
$semester = $_POST['createMeilensteinSemester'];

$query = "insert into meilenstein_global(Bezeichnung, Frist, Beschreibung, Semester_FK)
    values('$meilenstein', '$frist', '$beschreibung', '$semester')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();