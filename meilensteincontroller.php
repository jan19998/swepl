<?php
session_start();
require_once __DIR__ ."/vendor/autoload.php";
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

$gruppen_id = $_SESSION['gruppe'];
$semester = $_SESSION['semester'];

if(isset($_POST['date_of_completion']) and isset($_POST['selected_milestone'])) {
    $date = $_POST['date_of_completion'];
    $milestone =  $_POST['selected_milestone'];
    $check_status = "SELECT `Status` FROM Meilenstein  
                    WHERE Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer ='$gruppen_id' AND Semester_FK = '$semester')
                    AND Meilenstein_FK = (SELECT ID FROM Meilenstein_Global WHERE Bezeichnung = '$milestone' AND Semester_FK = '$semester');";
    $update1 = "INSERT INTO Meilenstein(Beendet, `Status`,Gruppe_FK,Meilenstein_FK)
                VALUES('$date',1,(SELECT ID FROM Gruppe WHERE Gruppennummer = '$gruppen_id'
                AND Semester_FK = '$semester'),(SELECT ID FROM Meilenstein_Global WHERE Semester_FK = '$semester' AND Bezeichnung = '$milestone'));";
    $update_datum_erreicht = "UPDATE Meilenstein SET Beendet = '$date' 
                                        WHERE Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer ='$gruppen_id' AND Semester_FK = '$semester')
                                        AND Meilenstein_FK = (SELECT ID FROM Meilenstein_Global WHERE Bezeichnung = '$milestone' AND Semester_FK = '$semester');";
    if($result = mysqli_query($remoteConnection,$check_status)) {
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt == 0) {
            mysqli_query($remoteConnection, $update1);
        }
        if ($row_cnt > 0) {
            mysqli_query($remoteConnection, $update_datum_erreicht);
        }
    }
    header('Location:betreuer.php');
}
