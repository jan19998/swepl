<div class="row">
    <?php
    $remoteConnection = mysqli_connect(
        "127.0.0.1", "root", "", "swepl"
    );

    $query = 'SELECT Gruppennummer FROM Gruppe WHERE Semester_FK = "'.$semester.'";';
        if ($result = mysqli_query($remoteConnection,$query)){
            while($row = mysqli_fetch_assoc($result)){
                echo '<div class="col-12">';
                    echo '<p><a class="link" href="betreuer.php?gruppe='.$row['Gruppennummer'].'&semester='.$semester.'">Gruppe '.$row['Gruppennummer'].'</a><br>';
                    echo 'Termin test </p>';
                echo '</div>';
            }
        }
    ?>
</div>