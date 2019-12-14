<?php
require_once "dbconnect.php";

$db = new dbconnect();

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $query = "INSERT into student (Nachname,Vorname,`E-Mail`,Matrikelnummer)
                   values ('$column[0]','$column[1]','$column[2]','$column[3]')";
            $result = mysqli_query($db->getConnection(), $query);
        }
    }
}

$db->close();

header('location: ' . $_SERVER['HTTP_REFERER']);