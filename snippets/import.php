<?php
require_once "dbconnect.php";

$db = new dbconnect();

$error = "";

$semester = $_POST["semester"];

$fileName = $_FILES["file"]["tmp_name"];

if ($_FILES["file"]["size"] > 0) {

    $file = fopen($fileName, "r");

    while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
        $query = "INSERT into student (Nachname,Vorname,`E-Mail`,Matrikelnummer, Semester_FK)
                   values ('$column[0]','$column[1]','$column[2]','$column[3]', '$semester')";
        $result = mysqli_query($db->getConnection(), $query);
        if (!$result) {
            $error = $error . 'Der Student mit der Matrikelnr.: ' . $column[3] . " existiert schon!\n";
        }
    }
}

$db->close();

echo $error;