<?php
    $positiv = 0;
    $neutral = 0;
    $negativ = 0;


    $query = 'SELECT 
               b.Bewertung
               FROM Bewertung b, Termin t, Gruppe g
               WHERE t.ID = b.Termin_FK
               AND t.Semester_FK = "'.$_SESSION['semester'].'"
               AND t.Gruppe_FK = g.ID
               AND g.Gruppennummer = "'.$_SESSION['gruppe'].'"';

    if($result = mysqli_query($remoteConnection,$query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['Bewertung'] == '+'){
                $positiv = $positiv + 1;
            }
            else if($row['Bewertung'] == '0'){
                $neutral = $neutral + 1;
            }
            else if($row['Bewertung'] == '-'){
                $negativ = $negativ + 1;
            }
        }
    }

?>

<table class="table text-center">
    <thead>
        <tr class="table-info">
            <th scope="col">Bewertung</th>
            <th scope="col">Anzahl</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>+</td>
            <td><?php echo $positiv?></td>
        </tr>
        <tr>
            <td>0</td>
            <td><?php echo $neutral?></td>
        </tr>
        <tr>
            <td>-</td>
            <td><?php echo $negativ?></td>
        </tr>
    </tbody>
</table>
