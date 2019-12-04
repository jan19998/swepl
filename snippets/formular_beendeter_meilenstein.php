<?php
//session_start()
//$gruppen_id = $_SESSION['selected_group_id']
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
    //Problem 1: er übernimmt das statusupdate nicht, daher sind die Farben der Tabelle immer fehlerhaft....
    //ich weiß nicht wieso er das Datum problemlos übernimmt, aber den Status nicht updatet
    $update1 .= 'UPDATE Meilenstein SET `Status` = 1 WHERE (SELECT DATEDIFF(Beendet,Frist)) <= 0;';
    if(mysqli_multi_query($remoteConnection,$update1)) {
       //Problem 2 Daten der Tabelle werden erst geupdatet, wenn die Seite komplett neu geladen wir, nicht direkt nach POST
        //daher versucht es so zu umgehen
        echo '<a href ="http://localhost/swepl/betreuer_meilenstein.php" class ="link">Tabelle updaten.</a>';
    }
    else {
        echo "fail";
    }
}
echo '<form action=http://localhost/swepl/betreuer_meilenstein.php method="POST">';
echo'<fieldset>';
echo '<legend> Meilenstein updaten <br>';
    echo ' <select name ="selected_milestone">';
    echo ' <option selected>';
     echo ' Meilenstein auswählen.';
      echo '</option>'     ;

$query = "SELECT Gruppe_FK,Bezeichnung FROM Meilenstein WHERE Gruppe_FK =1";
if($result = mysqli_query($remoteConnection,$query)){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<option>',$row['Bezeichnung'],'</option>';
                }
            }
        echo '</select>';
        echo '<br>';
        echo '<input type ="date" name="date_of_completion">';
        echo '<br>';
       echo '<input type ="submit" class ="btn border-0 btn-primary" value="Datum der Fertigstellung eintragen">';
       echo '</legend>';
    echo '</fieldset>';
echo '</form>';

?>
