<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select * from student where ID='$id'");
$student = mysqli_fetch_assoc($result);

echo json_encode($student);

$db->close();