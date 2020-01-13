<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$semester = $_SESSION['jahr'];

$query = "SELECT Gruppennummer, ID
    from gruppe
    WHERE Semester_FK='$semester'";
$result = mysqli_query($db->getConnection(), $query);
$gruppen = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($gruppen);