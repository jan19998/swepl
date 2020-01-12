<?php
session_start();
$gruppen_id = $_SESSION['gruppe'];
$semester = $_SESSION['semester'];
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);

if(isset($_POST['date_of_completion']) and isset($_POST['selected_milestone'])) {
    $date = $_POST['date_of_completion'];
    $milestone =  $_POST['selected_milestone'];
    $update1 = "INSERT INTO Meilenstein(Beendet, `Status`,Gruppe_FK,Meilenstein_FK)
VALUES('$date',1,(SELECT ID FROM Gruppe WHERE Gruppennummer = '$gruppen_id'
AND Semester_FK = '$semester'),(SELECT ID FROM Meilenstein_Global WHERE Semester_FK = '$semester' AND Bezeichnung = '$milestone'));";
    echo $update1;
    mysqli_autocommit($remoteConnection,false);
    mysqli_query($remoteConnection,$update1);
    if(!mysqli_commit($remoteConnection)) {
        echo 'error bei transaktion';
        mysqli_rollback($remoteConnection);
    }
    mysqli_commit($remoteConnection);
    //echo '<a class ="link" href = betreuer.php>Tabelle updaten.</a>';
    header('Location:betreuer.php');
}
