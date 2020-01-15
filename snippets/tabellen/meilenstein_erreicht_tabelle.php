<?php
//session_start()
//$gruppen_id = $_SESSION['selected_group_id']
$semester = $_SESSION['semester'];
$gruppe = $_SESSION['gruppe'];
$query = "SELECT Frist, Bezeichnung,Meilenstein.Beendet
FROM Meilenstein_Global 
iNNER JOIN Semester ON Semester.Kennung = Meilenstein_Global.Semester_FK
Inner JOIN Gruppe on Semester.Kennung = Gruppe.Semester_FK
LEFT JOIN Meilenstein ON Meilenstein_Global.ID = Meilenstein.Meilenstein_FK AND Gruppe.ID = Meilenstein.Gruppe_FK
Where Gruppe.ID = (Select ID from Gruppe where Gruppennummer = '$gruppe' and Semester_FK = '$semester')
;";
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
    if($result = mysqli_query($remoteConnection,$query)) {
        while ($row = mysqli_fetch_assoc($result)) {
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
            if($row['Frist'] != null) {
                $date1= new DateTime($row['Frist']);
                echo '><td>',$date1->format("d.m.y"),'</td>';
            }
            else {
                echo '<td>',$row['Frist'],'</td>';
            }



        echo '<td>',$row['Bezeichnung'],'</td>';
        if($row['Beendet'] != null) {
            $date3= new DateTime($row['Beendet']);
            echo '<td>',$date3->format("d.m.y")
            ,'</td>';
        }
        else {
            echo '<td>',$row['Beendet'],'</td>';
        }
        echo '</tr>';
       }

    }




    ?>
    </tbody>

</table>
