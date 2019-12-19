<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dozent</title>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-table-master/dist/bootstrap-table.css">
    <script src="https://kit.fontawesome.com/1b3fa84305.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>

<body>

<div class="container">

    <?php include("snippets/header.php") ;
    if(!isset($_SESSION['rolle']) || $_SESSION['rolle'] != "Dozent"){
        header("Location: startseite.php");
    }
    ?>

    <div class="row">

        <div class="col-2">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#ve" role="tab">Verwalten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#me" role="tab">Meilenstein</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#im" role="tab">Importieren</a>
                </li>
            </ul>
        </div>
        <div class="col">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="ve" role="tabpanel">
                    <div class="row">
                        <div class="col">
                            <?php include "snippets/tabellen/jahreTable.php"; ?>
                            <button type="button" onclick="deljahr()" class="btn mt-2 btn-block">Löschen</button>
                        </div>
                        <div class="col">
                            <?php include "snippets/tabellen/studentenTable.php"; ?>
                            <?php include "snippets/tabellen/betreuerTable.php"; ?>
                            <?php include "snippets/tabellen/gruppenTable.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="me" role="tabpanel">
                    <?php include "snippets/tabellen/meilensteineTable.php"; ?>
                </div>
                <div class="tab-pane fade" id="im" role="tabpanel">
                    <form action="snippets/import.php" method="post" name="uploadCSV" enctype="multipart/form-data">
                        <div class="row form-group">
                            <label for="file">Wähle CSV Datei</label>
                            <input class="form-control-file" type="file" name="file" id="file" accept=".csv" required>
                        </div>
                        <div class="row">
                            <button type="submit" id="submit" name="import" class="btn">Importieren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php include("snippets/footer.php") ?>

</div>

<script src="jQuery_v3.4.1.js"></script>
<script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
<script src="bootstrap-table-master/dist/bootstrap-table.js"></script>
<script src="bootstrap-table-master/dist/locale/bootstrap-table-de-DE.min.js"></script>
<script src="js/studentenJS.js"></script>
<script src="js/betreuerJS.js"></script>
<script src="js/gruppenJS.js"></script>
<script src="js/jahreJS.js"></script>
<script src="js/meilensteineJS.js"></script>
<script>
    var $tablestudenten = $("#tablestudenten");
    var $tablebetreuer = $("#tablebetreuer");
    var $tablegruppen = $("#tablegruppen");

    function showStudenten(jahr) {
        $("#betreuerTable").hide();
        $("#gruppenTable").hide();
        $.ajax({
            url: "snippets/retrieveStudenten.php",
            type: "post",
            data: {rjahr: jahr},
            success: function (response) {
                $tablestudenten.bootstrapTable('load', JSON.parse(response));
                $("#studentenTable").show();
            }
        });
    }

    function showBetreuer(jahr) {
        $("#studentenTable").hide();
        $("#gruppenTable").hide();
        $.ajax({
            url: "snippets/retrieveBetreuer.php",
            type: "post",
            data: {rjahr: jahr},
            success: function (response) {
                $tablebetreuer.bootstrapTable('load', JSON.parse(response));
                $("#betreuerTable").show();
            }
        });
    }

    function showGruppen(jahr) {
        $("#studentenTable").hide();
        $("#betreuerTable").hide();
        $.ajax({
            url: "snippets/retrieveGruppen.php",
            type: "post",
            data: {rjahr: jahr},
            success: function (response) {
                $tablegruppen.bootstrapTable('load', JSON.parse(response));
                $("#gruppenTable").show();
            }
        });
    }

</script>

<?php include "snippets/modal/studentenModal.php"; ?>
<?php include "snippets/modal/betreuerModal.php"; ?>
<?php include "snippets/modal/gruppenModal.php"; ?>
<?php include "snippets/modal/jahreModal.php"; ?>
<?php include "snippets/modal/meilensteineModal.php"; ?>

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Löschen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Wollen sie die zeile wirklich löschen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="deletesubmit">Speichern
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                </button>
            </div>
        </div>
    </div>
</div>

</body>
</html>