<?php
    $semester = 'ws19/20';
    $gruppe = 'e9';
    $email = "";
    $i = 0;

$remoteConnection = mysqli_connect(
        "127.0.0.1", "root","","swepl"
);

?>

<div class="row pb-2">
    <div id="e-mail-button-space" class="col-6">
        <?php
            $query1 = 'SELECT s.`E-Mail` FROM swepl.Student s,swepl.Gruppe g 
                       WHERE g.Semester_FK = "'.$semester.'"
                       AND s.Semester_FK = "'.$semester.'"
                       AND g.Gruppennummer = "'.$gruppe.'"
                       AND g.ID = s.Gruppe_FK';
            if($result1 = mysqli_query($remoteConnection,$query1)){
                while($row = mysqli_fetch_assoc($result1)){
                    if($i == 0) {
                        $email = $row['E-Mail'];
                    } else{
                        $email = $email.','.$row['E-Mail'];
                    }
                    $i = $i + 1;
                }
            }
          echo '<a href="mailto:'.$email.'" target="_blank" class="btn btn-primary">E-Mail an alle Kursteilnehmer</a>';
        ?>
    </div>
</div>
<div class="row">
    <?php
    $query2 = 'SELECT s.Vorname,s.Nachname,s.Matrikelnummer,s.`E-Mail` FROM swepl.Student s,swepl.Gruppe g 
              WHERE s.Semester_FK = "' . $semester . '" 
              AND g.Semester_FK = "'.$semester.'"
              AND g.Gruppennummer = "'.$gruppe.'"
              AND g.ID = s.Gruppe_FK;';
    if (mysqli_connect_errno()) {
        printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
        exit();
    }
    if ($result2 = mysqli_query($remoteConnection,$query2)){
        while($row = mysqli_fetch_assoc($result2)){
            echo '<div id="teilnehmer-col" class="col-6">';
                echo '<p>'.$row['Vorname'].' '.$row['Nachname'].' <br>';
                echo 'Matrikelnummer: '.$row['Matrikelnummer'].'<br>';
                echo 'E-Mail: <a class="link" href= "mailto:'.$row['E-Mail'].'">'.$row['E-Mail'].'</a><br>';
                echo '</p>';
            echo '</div>';
        }
    }
    mysqli_close($remoteConnection);
    ?>
</div>
