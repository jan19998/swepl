<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['rid'];

$result = mysqli_query($db->getConnection(), "Select * from benutzer where ID='$id'");
$betreuer = mysqli_fetch_assoc($result);

echo json_encode($betreuer);

$db->close();