function detailStudentFormatter(index, row) {
    return 'Matrikel: ' + row['matrikelnummer'] + '<br>'
        + 'Nachname: ' + row['nachname'] + '<br>'
        + 'Vorname: ' + row['vorname'] + '<br>'
        + 'Gruppe: ' + row['gruppe'] + '<br>'
        + 'E-Mail: ' + row['email'];
}

function operateStudentFormatter(value, row, index) {
    return [
        '<a class="studentEdit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-pen"></i>',
        '</a>  ',
        '<a class="studentRemove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateStudentEvents = {
    'click .studentEdit': function (e, value, row, index) {
        editStudent(row['id']);
    },
    'click .studentRemove': function (e, value, row, index) {
        delStudent(row['id']);
    }
};

$(document).ready()
{

    $("#createStudentButton").on("click", function () {
        $.ajax({
            url: "snippets/retrieveGruppenname.php",
            type: "post",
            success: function (response) {
                document.getElementById("createStudentGruppe").innerHTML = "";

                JSON.parse(response).forEach(function (data, index) {
                    $("#createStudentGruppe").append("<option value='" + data.ID + "'" + ">" + data.Gruppennummer + "</option>");
                });

                $("#createStudentForm")[0].reset();
                $("#createStudentForm").unbind("submit").bind("submit", function () {
                    var form = $(this);
                    var matrikel = $("#createStudentMatrikel").val();
                    var nachname = $("#createStudentNachname").val();
                    var vorname = $("#createStudentVorname").val();
                    var email = $("#createStudentEmail").val();
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            alert(response);
                            $tablestudenten.bootstrapTable('insertRow', {
                                index: 0,
                                row: {
                                    id: response.id,
                                    matrikelnummer: matrikel,
                                    vorname: vorname,
                                    nachname: nachname,
                                    gruppe: response.gruppe,
                                    email: email
                                }
                            });
                            $("#createStudentForm")[0].reset();
                            $("#createStudentModal").modal("hide");
                        }
                    });
                    return false;
                });
            }
        });
    });

}

function delStudent(id = null) {
    $("#deleteModal").modal();
    $("#deletesubmit").unbind("click").bind("click", function () {
        $.ajax({
            url: "snippets/deleteStudent.php",
            type: "POST",
            data: {did: id},
            success: function () {
                $tablestudenten.bootstrapTable("removeByUniqueId", id);
                $("#deleteModal").modal("hide");
            }
        });
    });
}

function editStudent(id = null) {
    $.ajax({
        url: "snippets/retrieveGruppenname.php",
        type: "post",
        success: function (gruppen) {
            $("#editStudentModal").modal();
            $("#editStudentId").val(0);
            $.ajax({
                url: 'snippets/retrieveSingleStudent.php',
                type: 'post',
                data: {rid: id},
                dataType: 'json',
                success: function (response) {
                    document.getElementById("editStudentGruppe").innerHTML = "";

                    JSON.parse(gruppen).forEach(function (data, index) {
                        if (data.Gruppennummer == response.Gruppennummer)
                            $("#editStudentGruppe").append("<option selected value='" + data.ID + "'" + ">" + data.Gruppennummer + "</option>");
                        else
                            $("#editStudentGruppe").append("<option value='" + data.ID + "'" + ">" + data.Gruppennummer + "</option>");
                    });

                    $("#editStudentMatrikel").val(response.Matrikelnummer);
                    $("#editStudentNachname").val(response.Nachname);
                    $("#editStudentVorname").val(response.Vorname);
                    $("#editStudentEmail").val(response['E-Mail']);
                    $("#editStudentId").val(response['ID']);
                    $("#editStudentForm").unbind("submit").bind("submit", function () {
                        var form = $(this);
                        var id = $("#editStudentId").val();
                        var matrikel = $("#editStudentMatrikel").val();
                        var nachname = $("#editStudentNachname").val();
                        var vorname = $("#editStudentVorname").val();
                        var email = $("#editStudentEmail").val();
                        var gruppe = $("#editStudentGruppe").val();
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            success: function (gruppenname) {
                                $tablestudenten.bootstrapTable("updateByUniqueId", {
                                    id: id,
                                    row: {
                                        matrikelnummer: matrikel,
                                        nachname: nachname,
                                        vorname: vorname,
                                        email: email,
                                        gruppe: JSON.parse(gruppenname)
                                    }
                                });
                                $("#editStudentModal").modal("hide");
                            }
                        });
                        return false;
                    });
                }
            });
        }
    });
}