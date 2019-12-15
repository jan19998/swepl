<?php
require_once "dbconnect.php";
$db = new dbconnect();

$id = $_POST['did'];

$query = "delete from benutzer where ID='$id'";

mysqli_query($db->getConnection(), $query);

if(mysqli_error($db->getConnection()))
    echo false;
else
    echo "geschafft";

$db->close();