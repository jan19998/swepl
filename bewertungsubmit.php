<?php
session_start();

$semester = 'ws19/20';
$gruppe = 'e9';
$email = "";
$i = 0;
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);
$id = (int)$_GET['id'];
$grpfk = (int)$_GET['grpfk'];
$checkbox = $_POST['checkbox'];

$query = "SELECT ID FROM student WHERE Gruppe_FK = " . $grpfk;
$result = mysqli_query($remoteConnection, $query);


$bewertung = $_POST['bewertung'];
$bemerkung = $_POST['bemerkung'];
$ampel = $_POST['ampel'];


$update = "INSERT INTO bewertung (Termin_FK,Ampelstatus,Bewertung,Kommentar) value ('$id','$ampel','$bewertung','$bemerkung');";
if (mysqli_query($remoteConnection, $update) === true) {
    $i = 0;
    while ($val = mysqli_fetch_array($result)) {
        if ($checkbox[$i] == $val['ID']) {
            $update2 = "INSERT INTO `ist bei` (Anwesend,Student_FK,Termin_FK) value ('1','$val[ID]','$id');";
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