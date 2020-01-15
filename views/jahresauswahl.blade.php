<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>SWEPl</title>
    <link rel="stylesheet" href="css/swepl.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>

<body>
<div class="container">
    <?php
    include('snippets/header.php');
    if(!isset($_SESSION['rolle']) || $_SESSION['rolle'] != "Betreuer")
    {
        header("Location: startseite.php");
    }

    $kennung = array();
    $query = "SELECT DISTINCT s.Kennung
FROM Semester AS s
INNER JOIN Gruppe AS g ON g.`Semester_FK` = s.Kennung
INNER JOIN `betreut` AS b ON b.`Gruppe_FK` = g.ID
INNER JOIN `Benutzer` AS be ON b.`Benutzer_FK` = be.`ID`
WHERE be.`E-Mail` ='".$_SESSION['user']."'ORDER BY s.Kennung DESC;";
    if ($result = mysqli_query($remoteConnection, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($kennung, $row);
        }
    }
    ?>
    <div class="row pb-3">
        <div class="col-9">
            <h3>
                Kursübersicht
            </h3>
        </div>
        <div class="col-3 justify-content-end" style="justify-content: flex-end;">
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @for($i = 0; $i < count($kennung); ++$i)
                    <a class="nav-link  @if($i == 0) active @endif " data-toggle="pill" href="#v-pills-{{$i}}" role="tab">{{$kennung[$i]['Kennung']}}</a>
                @endfor
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                @if(count($kennung) == 0) Keine Semester Gefunden @endif
                @for($i = 0; $i < count($kennung); ++$i)
                    <div class="tab-pane fade @if($i == 0) show active @endif" id="v-pills-{{$i}}" role="tabpanel" >
                        @include('jahresauswahl_gruppe',[
                                 'semester' => $kennung[$i]['Kennung']
                                 ])
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <?php include('snippets/footer.php');?>
</div>
</body>
</html>