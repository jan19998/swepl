<?php
require_once "dbconnect.php";
$db = new dbconnect();

$jahr = $_POST['createJahr'];

$query = "insert into semester
    values('$jahr')";

mysqli_query($db->getConnection(), $query);

$db->close();