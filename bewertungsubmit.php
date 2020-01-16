<?php
require __DIR__ ."/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
$remoteConnection = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME'),
    (int)getenv('DB_PORT')
);
session_start();
$semester = $_SESSION['semester'];
$gruppe = $_SESSION['gruppe'];
//$email = "";
//$i = 0;
//$id = (int)$_GET['id'];
//$grpfk = (int)$_GET['grpfk'];
$query = "SELECT ID FROM student WHERE Gruppe_FK = (SELECT Gruppe.ID FROM Gruppe WHERE Gruppe.Gruppennummer= '$gruppe' AND Semester_FK = '$semester');";
$result = mysqli_query($remoteConnection, $query);
$checkbox = $_POST['checkbox'];
//$bewertung = $_POST['bewertung'];
if(isset($_POST['bewertung']) && $_POST['bewertung'] != "Bewertung wählen"){
$bewertung = $_POST['bewertung'];}
else{
    $_SESSION['id'] = $id;
    $_SESSION['grpfk'] = $grpfk;
    $_SESSION['fehler'] = "Sie haben keine Bewertung abgegeben!!!<br>";
    header("Location: Bewertung.php");
}
//$bemerkung = $_POST['bemerkung'];
if (isset($_POST['bemerkung'])){
$bemerkung = $_POST['bemerkung'];}
//$ampel = $_POST['ampel'];
if (isset($_POST['ampel']) && $_POST['ampel'] != "Ampelstatus"){
$ampel = $_POST['ampel'];}
else{
    $_SESSION['id'] = $id;
    $_SESSION['grpfk'] = $grpfk;
    $_SESSION['fehler2'] = "Sie haben keinen Ampelstatus abgegeben!!!<br>";
    header("Location: Bewertung.php");
}
$termin = $_GET['id'];
mysqli_begin_transaction($remoteConnection);
$update = "INSERT INTO bewertung (Termin_FK,Ampelstatus,Bewertung,Kommentar) values((SELECT ID FROM Termin WHERE Datum= '$termin' 
AND Semester_FK = '$semester' AND Gruppe_FK = (SELECT ID FROM Gruppe 
WHERE Gruppennummer= '$gruppe' AND Semester_FK = '$semester')),'$ampel','$bewertung','$bemerkung');";
var_dump($checkbox);
if (mysqli_query($remoteConnection, $update) === true) {
    $i = 0;
    while ($val = mysqli_fetch_array($result)) {
        //var_dump($i);
        var_dump($val);
         if(count($checkbox)<=$i){
            $i = 0;
        }
        if ($checkbox[$i] == $val['ID']) {
            $update2 = "INSERT INTO `ist bei` (Anwesend,Student_FK,Termin_FK) values ('1','$val[ID]',(SELECT ID FROM Termin WHERE Datum= '$termin' 
                        AND Semester_FK = '$semester' AND Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer= '$gruppe' AND Semester_FK = '$semester')));";
            //var_dump($update2);
            echo '<br>';
            if (mysqli_query($remoteConnection, $update2) === true) {
                echo 'update 1<br>';
            }
            else{
                echo 'kein update <br>!';
                mysqli_rollback($remoteConnection);
            }
            $i++;
        } else {
            $update3 = "INSERT INTO `ist bei` (Anwesend,Student_FK,Termin_FK) value ('0','$val[ID]',(SELECT ID FROM Termin WHERE Datum= '$termin' 
                        AND Semester_FK = '$semester' AND Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer= '$gruppe' AND Semester_FK = '$semester')));";
            //var_dump($update3);
            echo '<br>';
            if (mysqli_query($remoteConnection, $update3) === true) {
                echo 'update 0 <br>';
            }
            else{
                echo 'kein update <br>!';
                mysqli_rollback($remoteConnection);
            }
        }
    }
    mysqli_commit($remoteConnection);
    exit();
    header('Location:betreuer.php');
} else {
    echo 'failed';
     mysqli_rollback($remoteConnection);
}
