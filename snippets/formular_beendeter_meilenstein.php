
<form action="meilensteincontroller.php" method="POST">
<div class="form-group">
<legend> Meilenstein updaten </legend>
<select class ="form-control w-50" name ="selected_milestone">
<option selected>
<label for="meilenstein_auswahlen">Meilenstein auswählen</label>
</option>
<?php
$query = "SELECT Bezeichnung
FROM Meilenstein_Global 
Where Semester_FK = '$semester';";

if($result = mysqli_query($remoteConnection,$query)){
    while($row = mysqli_fetch_assoc($result)){
        echo '<option>',$row['Bezeichnung'],'</option>';
    }
}
echo '</select>';
?>
</div>
<div class="form-group">
<label for="datum_auswahlen">Datum der Fertigstellung wählen</label>
<input class ="form-control w-25"  type ="date" name="date_of_completion">
</div>
    <input type ="submit" class ="btn border-0 btn-primary" value="Datum der Fertigstellung eintragen">
</form>

