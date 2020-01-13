<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select student.ID ID, Matrikelnummer, Nachname, Vorname, Gruppennummer, `E-Mail`
        from student
        left join gruppe on student.Gruppe_FK=gruppe.ID
        where student.ID='$id'");
$student = mysqli_fetch_assoc($result);

echo json_encode($student);

$db->close();