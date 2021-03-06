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
<div class ="container">
    <?php include('snippets/header.php');
    if(!isset($_SESSION['rolle']) || $_SESSION['rolle'] != "Betreuer"){
        header("Location: startseite.php");
    }
    if(isset($_GET['semester']) && isset($_GET['gruppe'])){
    $_SESSION['semester'] = $_GET['semester'];
    $_SESSION['gruppe'] = $_GET['gruppe'];}
    /* Falls man verhindern will, das durch Falsche Get werte man zugriff auf Gruppen erhält, zu dennen man keine Rechte hat
    if(isset($_SESSION['semester']) && $_SESSION['gruppe'] && $_SESSION['user'])
    {
$Userrighttest ="SELECT * FROM Gruppe AS g
INNER JOIN `betreut`AS br ON br.`Gruppe_FK` = g.`ID`
INNER JOIN `Benutzer` AS be ON be.`ID` = br.`Benutzer_FK`
WHERE be.`E-Mail` = '".$_SESSION['user']."' AND g.`Gruppennummer` = '".$_SESSION['gruppe']."' AND g.`Semester_FK` = '".$_SESSION['semester']."';";
if(mysqli_num_rows(mysqli_query($remoteConnection, $Userrighttest)) == 0){
    header("Location: jahresauswahl.php");
}
    }
    else{
        header("Location: jahresauswahl.php");
    } */
    ?>
    <div class ="row pb-3">
        <div class ="col-9">
            <h3>
                Gruppe <?php echo $_SESSION['gruppe'];?>
            </h3>
        </div>
        <div class="col-3 justify-content-end" style="justify-content: flex-end;">
            <a href="jahresauswahl.php" class="btn border-0 btn-primary">Zurück zur Kursübersicht</a>
        </div>
    </div>
    <div class="row">
        <div class ="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">Terminübersicht</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Kursteilnehmer</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="true">Meilensteine</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Statistiken</a>
            </div>
        </div>
        <div class ="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><?php include('snippets/terminuebersicht.php');?></div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><?php include('snippets/kursteilnehmer.php');?></div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"><?php include('snippets/tabellen/meilenstein_erreicht_tabelle.php');include('snippets/formular_beendeter_meilenstein.php');?></div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><?php include('snippets/statistiken.php')?></div>
            </div>
    </div>
    </div>
    <?php include('snippets/footer.php');?>
</div>
</body>
</html>





