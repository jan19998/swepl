<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dozent</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <!--<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-table-master/dist/bootstrap-table.css">-->
    <script src="https://kit.fontawesome.com/1b3fa84305.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>

<body>

<div class="container">

    <?php include("snippets/header.php");
    if (!isset($_SESSION['rolle']) || $_SESSION['rolle'] != "Dozent") {
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
                    <a class="nav-link" data-toggle="pill" href="#im" role="tab" id="import">Importieren</a>
                </li>
            </ul>
        </div>
        <div class="col-10">
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
                            <?php include "snippets/tabellen/termineTable.php"; ?>
                        </div>
                    </div>
                    <i data-toggle="tooltip"
                       data-html="true"
                       data-placement="right"
                       title="
                        In der linken Tabelle sehen Sie die vorhandenen Semester.<br><br>
                        Mit dem Plus Button können Sie weitere erstellen. Mit dem Löschen Button entfernen.<br><br>
                        Beim Semester können Sie wählen was Sie aus diesem Semester sehen wollen.
                        Darauf hin sehen Sie eine weiter Tabelle mit den Inhalten.<br><br>
                        Mit dem Plus Button über der Tabelle können weitere Einträge erstellt werden, mit dem Stift Button editiert und dem Mülleimer gelöscht.
                        Mit dem Plus Button in jeder Zeile erhalten Sie weiter Informationen zum Eintrag."
                       class="far fa-question-circle"></i>
                </div>
                <div class="tab-pane fade" id="me" role="tabpanel">
                    <?php include "snippets/tabellen/meilensteineTable.php"; ?>
                    <i data-toggle="tooltip"
                       data-html="true"
                       data-placement="right"
                       title="
                        In der Tabelle sehen Sie die vorhandenen Meilensteine.<br><br>
                        Mit dem Plus Button über der Tabelle können weitere Einträge erstellt werden, mit dem Stift Button editiert und dem Mülleimer gelöscht.
                        Mit dem Plus Button in jeder Zeile erhalten Sie weiter Informationen zum Eintrag."
                       class="far fa-question-circle"></i>
                </div>
                <div class="tab-pane fade" id="im" role="tabpanel">
                    <h3>Studentenimport</h3>
                    <form action="snippets/import.php" method="post" id="importstudent"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Wähle CSV Datei</label>
                            <input class="form-control-file" type="file" name="file" id="file" accept=".csv" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Wähle Semester</label>
                            <select class="form-control w-50" name="semester" id="semester" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn">
                                Importieren
                                <i id="loading" class="fas fa-circle-notch fa-spin none"></i>
                            </button>
                        </div>
                    </form>
                    <i data-toggle="tooltip"
                       data-html="true"
                       data-placement="right"
                       title="
                        Wählen Sie eine Datei im csv Format mit ; als Trennzeichen und ein Semester in das die Studenten importiert werden sollen."
                       class="far fa-question-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <?php include("snippets/footer.php") ?>

</div>

<script src="jQuery_v3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-de-DE.min.js"></script>
<!--<script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
<script src="bootstrap-table-master/dist/bootstrap-table.js"></script>
<script src="bootstrap-table-master/dist/locale/bootstrap-table-de-DE.min.js"></script>-->
<script src="js/studentenJS.js"></script>
<script src="js/betreuerJS.js"></script>
<script src="js/gruppenJS.js"></script>
<script src="js/jahreJS.js"></script>
<script src="js/meilensteineJS.js"></script>
<script src="js/termineJS.js"></script>
<script>
    var $tablestudenten = $("#tablestudenten");
    var $tablebetreuer = $("#tablebetreuer");
    var $tablegruppen = $("#tablegruppen");
    var $tabletermine = $("#tabletermine");

    $(document).ready()
    {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $("#importstudent").unbind("submit").bind("submit", function () {
            $("#loading").css("display", "block");
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    $("#loading").css("display", "none");
                    if (response.length > 0)
                        alert(response);
                }
            });
            return false;
        });
    }

    function showTermine(jahr) {
        $("#betreuerTable").hide();
        $("#gruppenTable").hide();
        $("#studentenTable").hide();
        $.ajax({
            url: "snippets/retrieveTermine.php",
            type: "post",
            data: {rjahr: jahr},
            success: function (response) {
                $tabletermine.bootstrapTable('load', JSON.parse(response));
                $("#termineTable").show();
            }
        });
    }

    function showStudenten(jahr) {
        $("#betreuerTable").hide();
        $("#gruppenTable").hide();
        $("#termineTable").hide();
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
        $("#termineTable").hide();
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
        $("#termineTable").hide();
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
<?php include "snippets/modal/termineModal.php"; ?>

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
                <p>Wollen sie die Zeile wirklich löschen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="deletesubmit">Löschen
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                </button>
            </div>
        </div>
    </div>
</div>

</body>
</html>