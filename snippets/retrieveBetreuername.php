<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_SESSION['jahr'];

$query = "Select ID id, concat(Vorname, ' ', Nachname) `name`
    from benutzer
    where IstDozent=0 and Semester_FK='$jahr'";
$result = mysqli_query($db->getConnection(), $query);
$betreuer = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($betreuer);