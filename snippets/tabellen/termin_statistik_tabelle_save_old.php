<?php
$anzahlTermineinsgesamt = 0;
$anzahlTermine = 0;

$query1 ='SELECT CONCAT( DAYOFMONTH(t.Datum),".",MONTH(t.Datum),".",YEAR(t.Datum)) AS Datum
From Termin t 
JOIN Gruppe g ON t.Gruppe_FK = g.ID
WHERE EXISTS (SELECT i.Student_FK FROM `ist bei` i WHERE  i.Termin_FK = t.ID)
	AND g.Gruppennummer = "'.$_SESSION['gruppe'].'"
	AND t.Gruppe_FK = g.ID
    AND t.Semester_FK = "'.$_SESSION['semester'].'"
GROUP BY t.Datum;';
$query2 ='SELECT CONCAT(s.Vorname," ", s.Nachname) AS Name, s.Matrikelnummer AS Matrikelnummer, CONCAT( DAYOFMONTH(t.Datum),".",MONTH(t.Datum),".",YEAR(t.Datum)) AS Datum, i.Anwesend AS Anwesend
FROM Student  s
JOIN `ist bei`  i ON i.Student_FK = s.ID
JOIN Termin t ON i.Termin_FK = t.ID
JOIN Gruppe g ON t.Gruppe_FK = g.ID
	WHERE g.Gruppennummer = "'.$_SESSION['gruppe'].'"
	AND t.Gruppe_FK = g.ID
    AND t.Semester_FK = "'.$_SESSION['semester'].'"
GROUP BY s.Matrikelnummer,t.Datum;';
?>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr class="table-info">
            <th scope="col" class="text-center table_width_statisitc">Matrikelnummer</th>
            <th scope="col" class="text-center table_width_statisitc">Name</th>
            <?php
            if($result = mysqli_query($remoteConnection,$query1)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<th scope="col " class="text-center">' . $row['Datum'] . '</th>';
                    $anzahlTermineinsgesamt++;
                };
            };
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if($result = mysqli_query($remoteConnection,$query2)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if($anzahlTermine == 0)
                {
                    echo '<tr></tr><td class="text-center">' . $row['Matrikelnummer'] . '</td>
                    <td class="text-center">' . $row['Name'] . '</td>';
                }
                echo '<td class="text-center">';
                if ($row['Anwesend']) {
                    echo '<i class="fa fa-check"></i>';
                } else {
                    echo '<i class="fa fa-times"></i>';
                }
                echo '</td>';
                $anzahlTermine++;
                if ($anzahlTermine == $anzahlTermineinsgesamt )
                {$anzahlTermine = 0;
                echo '</tr>';}
            };
        };
        ?>
        </tbody>
    </table>
</div>

<!--
        <th>
            Name
        </th>
        <td>Max Mustermann</td>
        <td>Max Mustermann</td>
        <td>Max Mustermann</td>
        <th>10.10</th>
            <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
            <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
            <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <th>10.10</th>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
        <tr> <input class="checkbox" type="checkbox" checked disabled> </tr>
-->



<!--
        <tr>
            <th scope="col position-static">Name</th>
            <th scope="col">10.10</th>
            <th scope="col">17.10</th>
            <th scope="col">24.10</th>
            <th scope="col">31.10</th>
            <th scope="col">7.11</th>
            <th scope="col">14.11</th>
            <th scope="col">21.11</th>
            <th scope="col">28.11</th>
            <th scope="col">4.12</th>
            <th scope="col">14.11</th>
            <th scope="col">11.12</th>
            <th scope="col">18.12</th>
            <th scope="col">25.12</th>
            <th scope="col">2.1</th>
            <th scope="col">9.1</th>
            <th scope="col">16.1</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Max Mustermann</th>
            <td> <input class="checkbox" type="checkbox" checked disabled> </td>
            <td><input class="checkbox" type="checkbox" disabled></td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <th scope="row">Max Mustermann</th>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <th scope="row">Max Mustermann</th>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>

-->