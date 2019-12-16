<div class="row">
    <div class="col-12">
        <?php
        $remoteConnection = mysqli_connect(
            "127.0.0.1", "root", "", "swepl"
        );
            $query = 'SELECT Datum FROM Termin WHERE Gruppen_FK = '.$_SESSION['gruppe'].' AND '.$_SESSION['semester'].';';
            if($result = mysqli_query($remoteConnection,$query)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<p><a class="link" href="#">'.$row['Datum'].'</a></p>';
                }
            }
        ?>
    </div>
</div>
