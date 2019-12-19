<?php
require_once "dbconnect.php";

$jahr = $_POST['djahr'];

$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "delete from semester where Kennung='$jahr'");

$db->close();