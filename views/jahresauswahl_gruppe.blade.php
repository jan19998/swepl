<div class="row">
    <?php
    require_once __DIR__ ."/../vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::create(__DIR__, '/../.env');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
    $remoteConnection = mysqli_connect(
        getenv('DB_HOST'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_NAME'),
        (int)getenv('DB_PORT')
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