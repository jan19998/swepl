<?php
require_once "dbconnect.php";
$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "Select Kennung jahr from semester order by Kennung");
$semester = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($semester);