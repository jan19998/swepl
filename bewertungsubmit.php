<?php
session_start();
$semester = $_SESSION['semester'];
$gruppe = $_SESSION['gruppe'];
//$email = "";
//$i = 0;
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);
//$id = (int)$_GET['id'];
//$grpfk = (int)$_GET['grpfk'];
$query = "SELECT ID FROM student WHERE Gruppe_FK = (SELECT Gruppe.ID FROM Gruppe WHERE Gruppe.Gruppennummer= '$gruppe' AND Semester_FK = '$semester');";
$result = mysqli_query($remoteConnection, $query);
$checkbox = $_POST['checkbox'];
$bewertung = $_POST['bewertung'];
$bemerkung = $_POST['bemerkung'];
$ampel = $_POST['ampel'];
$termin = $_GET['id'];
$update = "INSERT INTO bewertung (Termin_FK,Ampelstatus,Bewertung,Kommentar) values((SELECT ID FROM Termin WHERE Datum= '$termin' 
AND Semester_FK = '$semester' AND Gruppe_FK = (SELECT ID FROM Gruppe 
WHERE Gruppennummer= '$gruppe' AND Semester_FK = '$semester')),'$ampel','$bewertung','$bemerkung');";
if (mysqli_query($remoteConnection, $update) === true) {
    $i = 0;
    while ($val = mysqli_fetch_array($result)) {
        if ($checkbox[$i] == $val['ID']) {
            $update2 = "INSERT INTO `ist bei` (Anwesend,Student_FK,Termin_FK) values ('1','$val[ID]',(SELECT ID FROM Termin WHERE Datum= '$termin' 
                        AND Semester_FK = '$semester' AND Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer= '$gruppe' AND Semester_FK = '$semester')));";
            var_dump($update2);
            echo '<br>';
            if (mysqli_query($remoteConnection, $update2) === true) {
                echo 'update 1<br>';
            }
            $i++;
        } else {
            $update3 = "INSERT INTO `ist bei` (Anwesend,Student_FK,Termin_FK) value ('0','$val[ID]','$id');";
            var_dump($update3);
            echo '<br>';
            if (mysqli_query($remoteConnection, $update3) === true) {
                echo 'update 0 <br>';
            }
        }
    }
} else {
    echo 'failed';
}

?>
