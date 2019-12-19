<?php
require_once "dbconnect.php";

$db = new dbconnect();

$id = $_POST['editMeilensteinId'];
$meilenstein = $_POST['editMeilenstein'];
$frist = $_POST['editMeilensteinFrist'];
$semester = $_POST['editMeilensteinSemester'];
$beschreibung = $_POST['editMeilensteinBeschreibung'];

$query = "update meilenstein_global
    set ID='$id', Bezeichnung='$meilenstein', Beschreibung='$beschreibung', Frist='$frist', Semester_FK='$semester'
    where ID='$id'";

mysqli_query($db->getConnection(), $query);

$db->close();
