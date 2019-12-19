<?php

require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select * from meilenstein_global where ID='$id'");
$gruppe = mysqli_fetch_assoc($result);

echo json_encode($gruppe);

$db->close();