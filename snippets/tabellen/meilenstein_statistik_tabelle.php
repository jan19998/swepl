<?php

$semester = 'ws19/20';
$gruppe = 'e9';

$remoteConnection = mysqli_connect(
    "127.0.0.1", "root","","swepl"
);

$query = 'SELECT Frist, Bezeichnung,Meilenstein.`Status`
FROM Meilenstein_Global 
iNNER JOIN Semester ON Semester.Kennung = Meilenstein_Global.Semester_FK
Inner JOIN Gruppe on Semester.Kennung = Gruppe.Semester_FK
LEFT JOIN Meilenstein ON Meilenstein_Global.ID = Meilenstein.Meilenstein_FK AND Gruppe.ID = Meilenstein.Gruppe_FK
Where Gruppe.ID = (Select ID from Gruppe where Gruppennummer = "'.$_SESSION['gruppe'].'" and Semester_FK = "'.$_SESSION['semester'].'")
;';

?>
<div id="ms_table_scroll" class="table-responsive">
<table class="table text-center tableFixHead">
    <thead>
    <tr class="table-info">
        <th scope="col">Meilenstein</th>
        <th scope="col">eingehalten</th>
        <th scope="col">nicht eingehalten</th>
    </tr>
    </thead>
    <tbody>
        <?php
        if($result = mysqli_query($remoteConnection,$query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                    echo '<td>';
                        echo $row['Bezeichnung'];
                    echo '</td>';
                    echo '<td>';
                        if ($row['Status'] == 1) {
                            echo '<i class="fa fa-check"></i>';
                        } else if($row['Status'] == 0) {
                            echo '<i class="fa fa-times"></i>';
                        } else{
                            echo '<i class="fa fa-times"></i>';
                        }
                    echo '</td>';
                    echo '<td>';
                        if ($row['Status'] == 0) {
                            echo '<i class="fa fa-check"></i>';
                        } else if($row['Status'] == 1){
                            echo '<i class="fa fa-times"></i>';
                        } else {
                            echo '<i class="fa fa-check"></i>';
                        }
                    echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
</div>
