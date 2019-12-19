function detailGruppeFormatter(index, row) {
    return 'Gruppenname: ' + row['gruppenname'] + '<br>'
        + 'Termine: ' + row['termine'] + '<br>'
        + 'Raum: ' + row['raum'] + '<br>'
        + 'Betreuer: ' + row['betreuer'] + '<br>'
        + 'Studenten: ' + row['studenten'];
}

function operateGruppeFormatter(value, row, index) {
    return [
        '<a class="gruppeEdit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-pen"></i>',
        '</a>  ',
        '<a class="gruppeRemove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateGruppeEvents = {
    'click .gruppeEdit': function (e, value, row, index) {
        editGruppe(row['id']);
    },
    'click .gruppeRemove': function (e, value, row, index) {
        delGruppe(row['id']);
    }
};

$(document).ready()
{

    $("#createGruppeButton").on("click", function () {
        $("#createGruppeForm")[0].reset();
        $("#createGruppeForm").unbind("submit").bind("submit", function () {
            var form = $(this);
            var gruppenname = $("#createGruppeGruppenname").val();
            var termine = $("#createGruppeTermine").val();
            var raum = $("#createGruppeRaum").val();
            var betreuer = $("#createGruppeBetreuer").val();
            var studenten = $("#createGruppeStudenten").val();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    $tablegruppen.bootstrapTable('insertRow', {
                        index: 0,
                        row: {
                            id: response,
                            gruppenname: gruppenname,
                            termine: termine,
                            raum: raum,
                            betreuer: betreuer,
                            studenten: studenten
                        }
                    });
                    $("#createGruppeForm")[0].reset();
                    $("#createGruppeModal").modal("hide");
                }
            });
            return false;
        });
    });

}

function delGruppe(id = null) {
    $("#deleteModal").modal();
    $("#deletesubmit").unbind("click").bind("click", function () {
        $.ajax({
            url: "snippets/deleteGruppe.php",
            type: "POST",
            data: {did: id},
            success: function () {
                $tablegruppen.bootstrapTable("removeByUniqueId", id);
                $("#deleteModal").modal("hide");
            }
        });
    });
}

function editGruppe(id = null) {
    $("#editGruppeModal").modal();
    $("#editGruppeId").val(0);
    $.ajax({
        url: 'snippets/retrieveSingleGruppe.php',
        type: 'post',
        data: {rid: id},
        dataType: 'json',
        success: function (response) {
            $("#editGruppeGruppenname").val(response.Gruppennummer);
            $("#editGruppeRaum").val(response.Raum);
            $("#editGruppeTermine").val("");
            $("#editGruppeBetreuer").val("");
            $("#editGruppeStudenten").val("");
            $("#editGruppeId").val(response['ID']);
            $("#editGruppeForm").unbind("submit").bind("submit", function () {
                var form = $(this);
                var id = $("#editGruppeId").val();
                var gruppenname = $("#editGruppeGruppenname").val();
                var termine = $("#editGruppeTermine").val();
                var raum = $("#editGruppeRaum").val();
                var betreuer = $("#editGruppeBetreuer").val();
                var studenten = $("#editGruppeStudenten").val();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function () {
                        $tablegruppen.bootstrapTable("updateByUniqueId", {
                            id: id,
                            row: {
                                id: id,
                                gruppenname: gruppenname,
                                termine: termine,
                                raum: raum,
                                betreuer: betreuer,
                                studenten: studenten
                            }
                        });
                        $("#editGruppeModal").modal("hide");
                    }
                });
                return false;
            });
        }
    });
}