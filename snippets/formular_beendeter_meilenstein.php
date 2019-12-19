<?php
$gruppen_id = $_SESSION['gruppe'];
$semester = $_SESSION['semester'];
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);
//hier müsste man das WHERE anpassen mit der GruppenID, die in der Session gespeichert wurde
if(isset($_POST['date_of_completion']) and isset($_POST['selected_milestone'])) {
    $date = $_POST['date_of_completion'];
    $milestone =  $_POST['selected_milestone'];
    $update1 = 'UPDATE Meilenstein JOIN Meilenstein_Global ON Meilenstein.Meilenstein_FK = Meilenstein_Global.ID
                SET Meilenstein.Beendet =';
    $update1 .= " STR_TO_DATE('$date','%Y-%m-%d'), `Status` = 1 ";
    $update1 .= "WHERE Meilenstein.Gruppe_FK = (SELECT ID FROM Gruppe WHERE Gruppennummer= '$gruppen_id') 
                AND Meilenstein_Global.Semester_FK = '$semester' ";
    $update1 .= "AND Meilenstein_Global.Bezeichnung = '$milestone';";
   //echo $update1;
    mysqli_autocommit($remoteConnection,false);
    mysqli_query($remoteConnection,$update1);
    if(!mysqli_commit($remoteConnection)) {
        echo 'error bei transaktion';
        mysqli_rollback($remoteConnection);
    }
    mysqli_commit($remoteConnection);

    echo '<a class ="link" href = betreuer.php>Tabelle updaten.</a>';
}
echo '<form action=betreuer.php method="POST">';
echo'<div class="form-group">';
echo '<legend> Meilenstein updaten </legend>';
    echo ' <select class ="form-control" name ="selected_milestone">';
    echo ' <option selected>';
     echo ' <label for="meilenstein_auswahlen">Meilenstein auswählen</label>';
      echo '</option>'     ;

$query = "SELECT Meilenstein.Meilenstein_FK,Meilenstein.Gruppe_FK, Meilenstein.Beendet,Meilenstein.`Status`,Meilenstein_Global.Frist,
Meilenstein_Global.Bezeichnung 
FROM Meilenstein
JOIN Meilenstein_Global on Meilenstein_Global.ID = Meilenstein.Meilenstein_FK
WHERE Meilenstein.Gruppe_FK = (SELECT Gruppe.ID FROM Gruppe WHERE Gruppe.Gruppennummer= '$gruppe' AND Semester_FK = '$semester')";

if($result = mysqli_query($remoteConnection,$query)){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<option>',$row['Bezeichnung'],'</option>';
                }
            }
        echo '</select>';
echo'</div>';
echo'<div class="form-group">';
echo ' <label for="datum_auswahlen">Datum der Fertigstellung wählen</label>';
        echo '<input class ="form-control w-25"  type ="date" name="date_of_completion">';
echo'</div>';
       echo '<input type ="submit" class ="btn border-0 btn-primary" value="Datum der Fertigstellung eintragen">';
echo '</form>';
mysqli_close($remoteConnection);
?>
