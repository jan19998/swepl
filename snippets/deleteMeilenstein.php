<?php
require_once "dbconnect.php";

$id = $_POST['did'];

$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "delete from meilenstein_global where ID='$id'");

$db->close();