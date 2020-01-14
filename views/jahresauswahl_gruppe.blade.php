<div class="row">
    <?php
    $remoteConnection = mysqli_connect(
        "127.0.0.1", "root", "", "swepl"
    );

    $query = "SELECT g.Gruppennummer, g.Raum FROM Gruppe AS g
INNER JOIN `betreut` AS b ON b.`Gruppe_FK` = g.ID
INNER JOIN `Benutzer` AS be ON b.`Benutzer_FK` = be.`ID`
WHERE be.`E-Mail` = '".$_SESSION['user']."' AND g.Semester_FK = '".$semester."';";
        if ($result = mysqli_query($remoteConnection,$query)){
            while($row = mysqli_fetch_assoc($result)){
                echo '<div class="col-12">';
                    echo '<p><a class="link" href="betreuer.php?gruppe='.$row['Gruppennummer'].'&semester='.$semester.'">Gruppe '.$row['Gruppennummer'].'</a><br>';
                    echo 'Termin , '.$row['Raum'].'</p>';
                echo '</div>';
            }
        }
        else {
            echo $_SESSION['user'];
            echo $semester;
        }
    ?>
</div>