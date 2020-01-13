<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;

$result = mysqli_query($db->getConnection(), "Select termin.ID id, Gruppe_FK gruppe, Datum datum, gruppe.Gruppennummer gruppe
    from termin
    left join gruppe on termin.Gruppe_FK=gruppe.ID
    where termin.Semester_FK='$jahr' order by Datum");
$termine = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();

echo json_encode($termine);