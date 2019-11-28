<?php

$semester = 'ws19/20';
$gruppe = 'e9';

$remoteConnection = mysqli_connect(
    "127.0.0.1", "root","","swepl"
);

$query = 'SELECT m.Bezeichnung,m.`Status` FROM Meilenstein m,Gruppe g
          WHERE g.Semester_FK = "'.$semester.'"
          AND g.Gruppennummer = "'.$gruppe.'"
          AND m.Gruppe_FK = g.ID';

?>

<table class="table">
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
                        if ($row['Status']) {
                            echo '<i class="fa fa-check"></i>';
                        } else {
                            echo '<i class="fa fa-times"></i>';
                        }
                    echo '</td>';
                    echo '<td>';
                        if (!$row['Status']) {
                            echo '<i class="fa fa-check"></i>';
                        } else {
                            echo '<i class="fa fa-times"></i>';
                        }
                    echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
