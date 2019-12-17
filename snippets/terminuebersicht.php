<div class="row">
    <div class="col-12">
        <?php
        $remoteConnection = mysqli_connect(
            "127.0.0.1", "root", "", "swepl"
        );
            $gruppe = $_SESSION['gruppe'];
            $semester = $_SESSION['semester'];
            $query = "SELECT Termin.Datum,Gruppe.Semester_FK,Gruppe.ID,Gruppe.Gruppennummer FROM Gruppe
                      JOIN Termin ON Termin.Gruppe_FK = Gruppe.ID
                      WHERE Gruppe.Gruppennummer = '$gruppe' AND Gruppe.Semester_FK = '$semester';";
            //diese query funktionierte bei mir nicht (zeigte keine Daten an)
            //$query = "SELECT Datum FROM Termin WHERE Gruppen_FK = '$gruppe' AND '$semester';";
            if($result = mysqli_query($remoteConnection,$query)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['Datum'];
                    echo '<p><a class="link" href="Bewertung.php?termin=',$date,'">KW'.date_format(new DateTime($date),'W').', '.date_format(new DateTime($date),'d.m.Y').'</a></p>';
                }
            }
        ?>
    </div>
</div>
