<?php $semester = 'ws19/20';
$gruppe = 'e9';
$email = "";
$i = 0;
$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
); ?>
<div class="row">
    <div class="col-12">
        <?php //$id = (int) $_GET['id'];
        $query = 'SELECT Datum,Gruppe_FK,ID FROM termin where Gruppe_FK = 1 ';// .$id;
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        }
        if ($result = mysqli_query($remoteConnection, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $date = new DateTime($row['Datum']);
                ?>

                <ul class="list-unstyled">
                <li><a class="link" href="snippets/Bewertung.php<?php echo '?id= '.$row['ID'].'&&grpfk= '.$row['Gruppe_FK']?>">KW <?php echo $date->format('W'). ' ' .$row['Datum']; ?></a></li>
                </ul>
<?php
            }
        }
        mysqli_close($remoteConnection);
        ?>
    </div>
</div>