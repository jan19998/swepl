<?php
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];

$result = mysqli_query($db->getConnection(), "Select ID id, Matrikelnummer matrikelnummer, Nachname nachname, Vorname vorname, Gruppe_FK gruppe, `E-Mail` email
    from student where Semester_FK='$jahr' order by Matrikelnummer");
$studenten = mysqli_fetch_all($result, MYSQLI_ASSOC);
/*$studenten = [];
while($row = mysqli_fetch_array($result)) {
    array_push($studenten, array(
        "id" => $row['ID'],
        "matrikelnummer" => $row['Matrikelnummer'],
        "nachname" => $row['Nachname'],
        "vorname" => $row['Vorname'],
        "gruppe" => $row['Gruppe_FK'],
        "email" => $row['E-Mail']));
}*/
$db->close();

echo json_encode($studenten);