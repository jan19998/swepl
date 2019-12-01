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
        $query = 'SELECT termin.Datum,termin.Gruppe_FK,gruppe.ID FROM termin JOIN gruppe on termin.Gruppe_FK = gruppe.ID /*where ID =*/ ';// .$id;
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        }
        if ($result = mysqli_query($remoteConnection, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $date = new DateTime($row['Datum']);


                echo '<ul class="list-unstyled">';
                echo '<li><a href="#">'.'KW'.$date->format('W'). ' ' .$row['Datum'] . '</a></li>';
                echo '</ul>';
            }
        }
        mysqli_close($remoteConnection);
        ?>
    </div>
</div>