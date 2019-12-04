<?php
//session_start()
//$gruppen_id = $_SESSION['selected_group_id']

$remoteConnection = mysqli_connect(
    "127.0.0.1", "root","","swepl"
);
//hier müsste man das WHERE anpassen mit der GruppenID, die in der Session gespeichert wurde
$query = "SELECT `Status`,DATE_FORMAT(Frist, '%d/%m/%Y'),Gruppe_FK,DATE_FORMAT(Beendet, '%d/%m/%Y'),Bezeichnung  FROM Meilenstein WHERE Gruppe_FK =1 ORDER BY Frist";
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
            echo '<tr ';
            if($row['Status'] == 1) {
                echo 'class ="table-success" ';
            }
            else if ($row['Status'] == 0) {
                echo ' class ="table-danger" ';
            }
            else {
                ;
            }
            echo '><td>',$row["DATE_FORMAT(Frist, '%d/%m/%Y')"],'</td>';
            echo '<td>',$row['Bezeichnung'],'</td>';
            echo '<td>',$row["DATE_FORMAT(Beendet, '%d/%m/%Y')"],'</td>';
            echo '</tr>';
        }
    }

    ?>
    </tbody>

</table>
