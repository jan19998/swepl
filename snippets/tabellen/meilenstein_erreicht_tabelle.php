<?php
//session_start()
//$gruppen_id = $_SESSION['selected_group_id']
$semester = $_SESSION['semester'];
$gruppe = $_SESSION['gruppe'];
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root","","swepl"
);
//hier müsste man das WHERE anpassen mit der GruppenID, die in der Session gespeichert wurde
$query = "SELECT Meilenstein.Meilenstein_FK,Meilenstein.Gruppe_FK, Meilenstein.Beendet,Meilenstein.`Status`,Meilenstein_Global.Frist,
Meilenstein_Global.Bezeichnung 
FROM Meilenstein
JOIN Meilenstein_Global on Meilenstein_Global.ID = Meilenstein.Meilenstein_FK
WHERE Meilenstein.Gruppe_FK = (SELECT Gruppe.ID FROM Gruppe WHERE Gruppe.Gruppennummer= '$gruppe' AND Semester_FK = '$semester')";
//var_dump($query);
?>
<table class ="table">
    <thead>
        <tr class="table-info">
            <th scope="col">
                Frist
            </th>
            <th scope="col">
                Ereginis
            </th>
            <th scope="col">
                Erreichung
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
    if($result = mysqli_query($remoteConnection,$query)){
        while($row = mysqli_fetch_assoc($result)){
            $date1 = $row['Frist'];
            $date2 = $row['Beendet'];
            $datetime1 = date_create($date1);
            $datetime2 = date_create($date2);
            echo '<tr ';
            if($datetime1 < $datetime2) {
                echo ' class ="table-danger" ';
            }
            else if ($datetime1 >= $datetime2) {
                echo 'class ="table-success" ';
            }
            else {
                ;
            }
            echo '><td>',$row['Frist'],'</td>';
            echo '<td>',$row['Bezeichnung'],'</td>';
            echo '<td>',$row['Beendet'],'</td>';
            echo '</tr>';
        }
    }

    ?>
    </tbody>

</table>
