function detailMeilensteinFormatter(index, row) {
    return 'Meilenstein: ' + row['meilenstein'] + '<br>'
        + 'Fälligkeitsdatum: ' + row['frist'] + '<br>'
        + 'Semester: ' + row['semester'] + '<br>'
        + 'Beschreibung: ' + row['beschreibung'];
}

function operateMeilensteinFormatter(value, row, index) {
    return [
        '<a class="meilensteinEdit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-pen"></i>',
        '</a>  ',
        '<a class="meilensteinRemove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateMeilensteinEvents = {
    'click .meilensteinEdit': function (e, value, row, index) {
        editMeilenstein(row['id']);
    },
    'click .meilensteinRemove': function (e, value, row, index) {
        delMeilenstein(row['id']);
    }
};

$(document).ready()
{

    $("#createMeilensteinButton").on("click", function () {
        $.ajax({
            url: "snippets/retrieveJahre.php",
            type: "get",
            success: function (response) {
                document.getElementById("createMeilensteinSemester").innerHTML = "";

                JSON.parse(response).forEach(function (data, index) {
                    $("#createMeilensteinSemester").append("<option>" + data.jahr + "</option>");
                });

                $("#createMeilensteinForm")[0].reset();
                $("#createMeilensteinForm").unbind("submit").bind("submit", function () {
                    var form = $(this);
                    var meilenstein = $("#createMeilenstein").val();
                    var frist = $("#createMeilensteinFrist").val();
                    var semester = $("#createMeilensteinSemester").val();
                    var beschreibung = $("#createMeilensteinBeschreibung").val();
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $("#tablemeilensteine").bootstrapTable('insertRow', {
                                index: 0,
                                row: {
                                    id: response,
                                    meilenstein: meilenstein,
                                    frist: frist,
                                    beschreibung: beschreibung,
                                    semester: semester
                                }
                            });
                            $("#createMeilensteinForm")[0].reset();
                            $("#createMeilensteinModal").modal("hide");
                        }
                    });
                    return false;
                });
            }
        });
    });

}

function delMeilenstein(id = null) {
    $("#deleteModal").modal();
    $("#deletesubmit").unbind("click").bind("click", function () {
        $.ajax({
            url: "snippets/deleteMeilenstein.php",
            type: "POST",
            data: {did: id},
            success: function () {
                $("#tablemeilensteine").bootstrapTable("removeByUniqueId", id);
                $("#deleteModal").modal("hide");
            }
        });
    });
}

function editMeilenstein(id = null) {
    $.ajax({
        url: "snippets/retrieveJahre.php",
        type: "get",
        success: function (semester) {
            $("#editMeilensteinModal").modal();
            $("#editMeilensteinId").val(0);
            $.ajax({
                url: 'snippets/retrieveSingleMeilenstein.php',
                type: 'post',
                data: {rid: id},
                dataType: 'json',
                success: function (response) {
                    document.getElementById("editMeilensteinSemester").innerHTML = "";

                    JSON.parse(semester).forEach(function (data, index) {
                        if (data.jahr == response.Semester_FK)
                            $("#editMeilensteinSemester").append("<option selected>" + data.jahr + "</option>");
                        else
                            $("#editMeilensteinSemester").append("<option>" + data.jahr + "</option>");
                    });

                    $("#editMeilenstein").val(response.Bezeichnung);
                    $("#editMeilensteinFrist").val(response.Frist);
                    $("#editMeilensteinBeschreibung").val(response.Beschreibung);
                    $("#editMeilensteinSemester").val(response.Semester_FK);
                    $("#editMeilensteinId").val(response['ID']);
                    $("#editMeilensteinForm").unbind("submit").bind("submit", function () {
                        var form = $(this);
                        var id = $("#editMeilensteinId").val();
                        var meilenstein = $("#editMeilenstein").val();
                        var frist = $("#editMeilensteinFrist").val();
                        var semester = $("#editMeilensteinSemester").val();
                        var beschreibung = $("#editMeilensteinBeschreibung").val();
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            success: function () {
                                $("#tablemeilensteine").bootstrapTable("updateByUniqueId", {
                                    id: id,
                                    row: {
                                        id: id,
                                        meilenstein: meilenstein,
                                        frist: frist,
                                        beschreibung: beschreibung,
                                        semester: semester
                                    }
                                });
                                $("#editMeilensteinModal").modal("hide");
                            }
                        });
                        return false;
                    });
                }
            });
        }
    });
}