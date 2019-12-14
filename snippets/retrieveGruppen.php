<?php
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];

$result = mysqli_query($db->getConnection(), "Select ID id, Gruppennummer gruppenname
    from gruppe where Semester_FK='$jahr'");
$gruppen = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($gruppen);