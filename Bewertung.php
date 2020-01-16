<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>SWEPl</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>

<body>
<?php //$semester = 'ws19/20';
//$gruppe = 'e9';
//$email = "";
//$i = 0;
 ?>
<?php
?>
<?php $gruppe = 'e9' ?>
<div class ="container">
    <?php include('snippets/header.php');
    if(!isset($_SESSION['rolle']) || $_SESSION['rolle'] != "Betreuer"){
        header("Location: startseite.php");
    }?>
    
    <?php
    if (isset($_SESSION['fehler'])){
        echo $_SESSION['fehler'];
        unset($_SESSION['fehler']);
    }
    if (isset($_SESSION['fehler2'])){
        echo $_SESSION['fehler2'];
        unset($_SESSION['fehler2']);
    }
    ?>
    <?php
    $gruppe = $_SESSION['gruppe']; //ID übergeben für Termin_ID
    $semester = $_SESSION['semester']; //ID übergeben für Gruppen_ID
    $query = "SELECT Termin.Datum,Gruppe.Semester_FK,Gruppe.ID,Gruppe.Gruppennummer FROM Gruppe
                      JOIN Termin ON Termin.Gruppe_FK = Gruppe.ID
                      WHERE Gruppe.Gruppennummer = '$gruppe' AND Gruppe.Semester_FK = '$semester';";
    $result = mysqli_query($remoteConnection, $query);
    $row = mysqli_fetch_assoc($result);
    $date = new DateTime($row['Datum']);
    $query2 = "SELECT Vorname,Nachname,ID FROM student where Gruppe_FK = (SELECT Gruppe.ID FROM Gruppe WHERE Gruppe.Gruppennummer= '$gruppe' AND Semester_FK = '$semester') ORDER BY ID;"; // Ihre SQL Query aus HeidiSQL
    $name = mysqli_query($remoteConnection, $query2);
    $datum = new DateTime($_GET['termin'])?>
    <div class ="row pb-3">
        <div class ="col-9">
            <h3>
                Gruppe <?php echo $gruppe .' '.'KW'.$date->format('W'). ' ' .$datum->format('d.m.Y') ?>
            </h3>
        </div>
        <div class="col-3 justify-content-end" style="justify-content: flex-end;">
            <a href="betreuer.php" class="btn border-0 btn-primary">Zurück zur Terminauswahl</a>
        </div>
    </div>
    <div class="row">
       <div class="col-12">
           <form action="bewertungsubmit.php<?php echo '?id='.$_GET['termin']?>" method="post">
               <fieldset class="border border-dark">
                   <legend class="w-auto">Bewertung der Gruppe</legend>
                   <div class="row">
                       <div class="col-4">
                           <label for="ampel" class="pl-4">Ampelstatus der Gruppe</label>
                       </div>
                       <div class="col-8">
                            <div class="col-4">
                                <select name="ampel" id="ampel" required>
                                    <option disabled selected hidden value="">Ampelstatus</option>
                                    <option>Grün</option>
                                    <option>Gelb</option>
                                    <option>Rot</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-4">
                            <label for="bewertung" class="pl-4">Eigene Bewertung der Gruppe</label>
                       </div>
                       <div class="col-8">
                           <div class="col-4">
                               <select name="bewertung" id="bewertung" required>
                                   <option disabled selected hidden value="">Bewertung wählen</option>
                                   <option>+</option>
                                   <option>-</option>
                                   <option>0</option>
                               </select>
                           </div>
                       </div>
                       <div class="col-4">
                           <p class="pl-4">Weitere Anmerkungen</p>
                       </div>
                       <div class="col-8">
                           <textarea rows="6"  class="bewertungTextArea" name="bemerkung" placeholder="Geben Sie eine Anmerkung ein, wenn Sie möchten..."></textarea>
                       </div>
                   </div>
                   <div class="row pt-4 pr-4">
                       <div class="col-4">
                           <p class="pl-4">Anwesenheiten</p>
                       </div>
                       <div class="col-8">
                           <table class="table">
                               <thead>
                               <tr>
                                   <th>Name</th>
                                   <th>Anwesend</th>
                               </tr>
                               </thead>
                               <tbody>
                               <?php
                               while ($val = mysqli_fetch_array($name)) {
                                   ?>
                                   <tr>
                                       <td><?php echo $val['Vorname'],$val['Nachname'] ?></td>
                                       <td><input type="checkbox" name="checkbox[]" value="<?php echo $val['ID'] ?>"></td>
                                   </tr>
                                   <?php
                               }
                               ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="row pb-4">
                       <div class="col-9">

                       </div>
                       <div class="col-3">
                           <button type="submit" value="Submit" name="button5" class="btn border-0 btn-primary">Absenden</button>
                       </div>
                   </div>
               </fieldset>
           </form>
       </div>
    </div>
    <?php include('snippets/footer.php');?>
</div>
</body>
</html>





