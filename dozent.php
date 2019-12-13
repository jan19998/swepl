<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dozent</title>
    <?php //include("snippets/links.php") ?>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-table-master/dist/bootstrap-table.css">
    <script src="https://kit.fontawesome.com/1b3fa84305.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>

<?php
require_once "snippets/dbconnect.php";
$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "Select * from student order by Matrikelnummer");
$studenten = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();
?>

<body>

<div class="container">

    <?php include("snippets/header.php") ?>

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
                    <div id="toolbar">
                        <button type="button" id="createButton" class="btn" data-toggle="modal"
                                data-target="#createModal">
                            create
                        </button>
                    </div>
                    <table
                            id="table"
                            data-search="true"
                            data-toggle="table"
                            data-toolbar="#toolbar"
                            data-detail-view="true"
                            data-detail-formatter="detailFormatter"
                            data-pagination="true"
                            data-unique-id="id"
                            data-page-list="[10, 25, 50, 100, all]">
                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="matrikelnummer" data-sortable="true">Matrikelnummer</th>
                            <th data-field="nachname" data-sortable="true">Nachname</th>
                            <th data-field="vorname" data-sortable="true">Vorname</th>
                            <th data-field="gruppe" data-sortable="true">Gruppe</th>
                            <th data-field="email" data-visible="false">E-Mail</th>
                            <th data-field="operate" data-formatter="operateFormatter"
                                data-events="window.operateEvents">Operate
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($studenten as $student) {
                            ?>
                            <tr>
                                <td><?php echo $student['ID']; ?></td>
                                <td><?php echo $student['Matrikelnummer']; ?></td>
                                <td><?php echo $student['Nachname']; ?></td>
                                <td><?php echo $student['Vorname']; ?></td>
                                <td><?php echo $student['Gruppe_FK']; ?></td>
                                <td><?php echo $student['E-Mail']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="me" role="tabpanel">
                    test2
                </div>
                <div class="tab-pane fade" id="im" role="tabpanel">
                    <form action="snippets/import.php" method="post" name="uploadCSV" enctype="multipart/form-data">
                        <div class="row form-group">
                            <label for="file">Wähle CSV Datei</label>
                            <input class="form-control-file" type="file" name="file" id="file" accept=".csv">
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
<?php //include("snippets/scripts.php") ?>
<script>
    var $table = $("#table");

    function detailFormatter(index, row) {
        return 'ID: ' + row['id'] + '<br>'
            + 'Matrikel: ' + row['matrikelnummer'] + '<br>'
            + 'Nachname: ' + row['nachname'] + '<br>'
            + 'Vorname: ' + row['vorname'] + '<br>'
            + 'Gruppe: ' + row['gruppe'] + '<br>'
            + 'E-Mail: ' + row['email'];
    }

    function operateFormatter(value, row, index) {
        return [
            '<a class="edit" href="javascript:void(0)" title="Edit">',
            '<i class="fa fa-pen"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }

    window.operateEvents = {
        'click .edit': function (e, value, row, index) {
            edit(row['id']);
        },
        'click .remove': function (e, value, row, index) {
            del(row['id']);
        }
    };

    $(document).ready()
    {

        $("#createButton").on("click", function () {
            $("#createForm")[0].reset();
            $("#createForm").unbind("submit").bind("submit", function () {
                var form = $(this);
                var matrikel = $("#creatematrikel").val();
                var nachname = $("#createnachname").val();
                var vorname = $("#createvorname").val();
                var email = $("#createemail").val();
                var gruppe = $("#creategruppe").val();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $table.bootstrapTable('insertRow', {
                            index: 0,
                            row: {
                                id: response,
                                matrikelnummer: matrikel,
                                vorname: vorname,
                                nachname: nachname,
                                gruppe: gruppe,
                                email: email
                            }
                        });
                        $("#createForm")[0].reset();
                        $("#createModal").modal("hide");
                    }
                });
                //$("#createModal").modal("hide");
                return false;
            });
        });

    }

    function del(id = null) {
        $("#deleteModal").modal();
        $("#deletesubmit").unbind("click").bind("click", function () {
            $.ajax({
                url: "snippets/delete.php",
                type: "POST",
                data: {did: id},
                success: function () {
                    $table.bootstrapTable("removeByUniqueId", id);
                    $("#deleteModal").modal("hide");
                }
            });
        });
    }

    function edit(id = null) {
        $("#editModal").modal();
        $("#editid").val(0);
        $.ajax({
            url: 'snippets/retrieve.php',
            type: 'post',
            data: {rid : id},
            dataType: 'json',
            success:function(response) {
                $("#editmatrikel").val(response.Matrikelnummer);
                $("#editnachname").val(response.Nachname);
                $("#editvorname").val(response.Vorname);
                $("#editgruppe").val(response.Gruppe_FK);
                $("#editemail").val(response['E-Mail']);
                $("#editid").val(response['ID']);
                $("#editForm").unbind("submit").bind("submit", function () {
                    var form = $(this);
                    var id = $("#editid").val();
                    var matrikel = $("#editmatrikel").val();
                    var nachname = $("#editnachname").val();
                    var vorname = $("#editvorname").val();
                    var email = $("#editemail").val();
                    var gruppe = $("#editgruppe").val();
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        success: function () {
                            $table.bootstrapTable("updateByUniqueId", {
                                id: id,
                                row: {
                                    matrikelnummer: matrikel,
                                    nachname: nachname,
                                    vorname: vorname,
                                    email: email,
                                    gruppe: gruppe
                                }
                            });
                            $("#editModal").modal("hide");
                        }
                    });
                    return false;
                });
            }
        });
    }

</script>

<!-- Modal -->
<div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insert.php" method="post" id="createForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="creatematrikel">Matrikelnummer</label>
                        <input class="mt-2 form-control col mr-3" type="number" id="creatematrikel"
                               name="creatematrikel" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createnachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createnachname"
                               name="createnachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createvorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createvorname"
                               name="createvorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="creategruppe">Gruppe</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="creategruppe"
                               name="creategruppe" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="createemail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="createemail"
                               name="createemail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createsubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bearbeiten</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/update.php" method="post" id="editForm">
                <div class="modal-body">
                    <input type="hidden" id="editid" name="editid">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="editmatrikel">Matrikelnummer</label>
                        <input class="mt-2 form-control col mr-3" type="number" id="editmatrikel"
                               name="editmatrikel" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editnachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editnachname"
                               name="editnachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editvorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editvorname"
                               name="editvorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editgruppe">Gruppe</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editgruppe"
                               name="editgruppe" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="editemail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="editemail"
                               name="editemail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="editsubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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