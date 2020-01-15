<?php
$letztematrikelnummer = (string)"NULL";
$positiondatum = (int)0;

$query1 ='SELECT CONCAT( DAYOFMONTH(t.Datum),".",MONTH(t.Datum),".",YEAR(t.Datum)) AS Datumausgabe, t.Datum
From Termin t 
JOIN Gruppe g ON t.Gruppe_FK = g.ID
WHERE EXISTS (SELECT i.Student_FK FROM `ist bei` i WHERE  i.Termin_FK = t.ID)
	AND g.Gruppennummer = "'.$_SESSION['gruppe'].'"
	AND t.Gruppe_FK = g.ID
    AND t.Semester_FK = "'.$_SESSION['semester'].'"
GROUP BY t.Datum;';
$query2 ='SELECT CONCAT(s.Vorname," ", s.Nachname) AS Name, s.Matrikelnummer AS Matrikelnummer, t.Datum, i.Anwesend AS Anwesend
FROM Student  s
JOIN `ist bei`  i ON i.Student_FK = s.ID
JOIN Termin t ON i.Termin_FK = t.ID
JOIN Gruppe g ON t.Gruppe_FK = g.ID
	WHERE g.Gruppennummer = "'.$_SESSION['gruppe'].'"
	AND t.Gruppe_FK = g.ID
    AND t.Semester_FK = "'.$_SESSION['semester'].'"
GROUP BY s.Matrikelnummer,t.Datum;';

$arraytermmin = array();
if($result = mysqli_query($remoteConnection,$query1)) {
    while ($row = mysqli_fetch_assoc($result))
    {
        array_push($arraytermmin,$row);
    };
};
$arrayanwesenheit = array();
if($result = mysqli_query($remoteConnection,$query2)) {
    while ($row = mysqli_fetch_assoc($result)) {
array_push($arrayanwesenheit,$row);
    };
};

?>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr class="table-info">
            <th scope="col" class="text-center table_width_statisitc">Matrikelnummer</th>
            <th scope="col" class="text-center table_width_statisitc">Name</th>
            <?php
            if($result = mysqli_query($remoteConnection,$query1)) {
                for($i = 0; $i < count($arraytermmin); ++$i) {
                    echo '<th scope="col " class="text-center">' . $arraytermmin[$i]['Datumausgabe'] . '</th>';
                };
            };
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($arrayanwesenheit) > 0) {
            $i = 0;
            while($i < count($arrayanwesenheit)) {
                // Zeilenwechsel
                if($letztematrikelnummer != $arrayanwesenheit[$i]['Matrikelnummer'])
                {
                    if($i != 0) {
                        //letzten Spalten der Alten Zeile füllen
                        while($positiondatum < count($arraytermmin)){
                            echo '<td class="text-center"><i class="fa fa-question"></i></td>';
                            $positiondatum++;
                        }
                        $positiondatum = 0;
                    }
                    // Matrikelnummer und Name schreiben
                    echo '</tr><tr></tr><td class="text-center">' . $arrayanwesenheit[$i]['Matrikelnummer'] . '</td>
                    <td class="text-center">' . $arrayanwesenheit[$i]['Name'] . '</td>';
                }
                //Abbrechen wenn Position über das Datum Array fällt, sollte nicht möglich sein
                elseif ($positiondatum == count($arraytermmin)){
                    break;
                }
                $letztematrikelnummer = $arrayanwesenheit[$i]['Matrikelnummer'];
                //Anwesenheit wenn Datum Stimmt
                if($arrayanwesenheit[$i]['Datum'] == $arraytermmin[$positiondatum]['Datum'])
                {
                    if ($arrayanwesenheit[$i]['Anwesend']) {
                        echo '<td class="text-center"><i class="fa fa-check"></i></td>';
                    }
                    else if (!$arrayanwesenheit[$i]['Anwesend']) {
                        echo '<td class="text-center"><i class="fa fa-times"></i></td>';
                    }
                    $positiondatum++;
                    $i++;
                }
                //Falls Datum nicht übereinstimmt
                else {
                    //Falls Termin Datum eine Spalte Weiter rechts sein müsste
                    if($arrayanwesenheit[$i]['Datum'] > $arraytermmin[$positiondatum]['Datum']) {
                        echo '<td class="text-center"><i class="fa fa-question"></i></td>';
                        $positiondatum++;
                    }
                    // Falls die Spalte nicht exisitiert sollte nicht vor kommen
                    else{
                        $i++;
                    }
                }
            };
            //Falls Letzte Person am ende keine Daten mehr hat
            while ($positiondatum < count($arraytermmin)){
                echo '<td class="text-center"><i class="fa fa-question"></i></td>';
                $positiondatum++;
            };
            echo '</tr>';
        };
        ?>
        </tbody>
    </table>
</div>
