<?php
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
}
echo '<form action=betreuer.php method="POST">';
echo'<div class="form-group">';
echo '<legend> Meilenstein updaten </legend>';
    echo ' <select class ="form-control w-50" name ="selected_milestone">';
    echo ' <option selected>';
     echo ' <label for="meilenstein_auswahlen">Meilenstein auswählen</label>';
      echo '</option>'     ;

$query = "SELECT Bezeichnung
FROM Meilenstein_Global 
Where Semester_FK = '$semester';";

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
