<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$semester = $_SESSION['jahr'];

$query = "SELECT ID, Datum
    from termin
    WHERE Semester_FK='$semester'";
$result = mysqli_query($db->getConnection(), $query);
$termine = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($termine);