<?php
//session_start()
//$gruppen_id = $_SESSION['selected_group_id']
$semester = 'ws19/20';
$gruppe = 'e9';
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);
//hier müsste man das WHERE anpassen mit der GruppenID, die in der Session gespeichert wurde
if(isset($_POST['date_of_completion']) and isset($_POST['selected_milestone'])) {
    $date = $_POST['date_of_completion'];
    $milestone =  $_POST['selected_milestone'];
    $update1 = 'UPDATE Meilenstein SET Beendet =';
    $update1 .= " STR_TO_DATE('$date','%Y-%m-%d') ";
    $update1 .= "WHERE Gruppe_FK = 1 AND Bezeichnung = ";
    $update1 .= " '$milestone' ;";
    $update2 = ' UPDATE Meilenstein SET `Status` = 1';
    $update2 .= "WHERE Gruppe_FK = 1 AND Bezeichnung = ";
    $update2 .= " '$milestone' ;";
    mysqli_autocommit($remoteConnection,false);
    mysqli_query($remoteConnection,$update1);
    mysqli_query($remoteConnection,$update2);

    if(!mysqli_commit($remoteConnection)) {
        echo 'error bei transaktion';
        mysqli_rollback($remoteConnection);
    }
    mysqli_commit($remoteConnection);

    echo '<a class ="link" href = "http://localhost/swepl/betreuer.php">Tabelle updaten.</a>';
}
echo '<form action=http://localhost/swepl/betreuer.php method="POST">';
echo'<div class="form-group">';
echo '<legend> Meilenstein updaten </legend>';
    echo ' <select name ="selected_milestone">';
    echo ' <option selected>';
     echo ' <label for="meilenstein_auswahlen">Meilenstein auswählen</label>';
      echo '</option>'     ;

$query = "SELECT Gruppe_FK,Bezeichnung FROM Meilenstein WHERE Gruppe_FK =1";
if($result = mysqli_query($remoteConnection,$query)){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<option>',$row['Bezeichnung'],'</option>';
                }
            }
        echo '</select>';
echo'</div>';
echo'<div class="form-group">';
echo ' <label for="datum_auswahlen">Datum der Fertigstellung wählen</label>';
        echo '<input type ="date" name="date_of_completion">';
echo'</div>';
       echo '<input type ="submit" class ="btn border-0 btn-primary" value="Datum der Fertigstellung eintragen">';
echo '</form>';
mysqli_close($remoteConnection);
?>
