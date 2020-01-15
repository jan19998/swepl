function detailGruppeFormatter(index, row) {
    return 'Gruppenname: ' + row['gruppenname'] + '<br>'
        + 'Termine: ' + row['termine'] + '<br>'
        + 'Raum: ' + row['raum'] + '<br>'
        + 'Wochentag: ' + row['wochentag'] + '<br>'
        + 'Uhrzeit: ' + row['uhrzeit'] + '<br>'
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
        $.ajax({
            url: "snippets/retrieveBetreuername.php",
            type: "post",
            success: function (response) {
                document.getElementById("createGruppeBetreuer").innerHTML = "";

                JSON.parse(response).forEach(function (data, index) {
                    $("#createGruppeBetreuer").append("<option value='" + data.id + "'" + ">" + data.name + "</option>");
                });

                $("#createGruppeForm")[0].reset();
                $("#createGruppeForm").unbind("submit").bind("submit", function () {
                    var form = $(this);
                    var gruppenname = $("#createGruppeGruppenname").val();
                    var raum = $("#createGruppeRaum").val();
                    var wochentag = $("#createGruppeWochentag").val();
                    var uhrzeit = $("#createGruppeUhrzeit").val();
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $tablegruppen.bootstrapTable('insertRow', {
                                index: 0,
                                row: {
                                    id: response.id,
                                    gruppenname: gruppenname,
                                    termine: null,
                                    betreuer: response.betreuer,
                                    studenten: null,
                                    raum: raum,
                                    wochentag: wochentag,
                                    uhrzeit: uhrzeit + ':00'
                                }
                            });
                            $("#createGruppeForm")[0].reset();
                            $("#createGruppeModal").modal("hide");
                        }
                    });
                    return false;
                });
            }
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
    $.ajax({
        url: "snippets/retrieveBetreuername.php",
        type: "post",
        success: function (betreuer) {
            $("#editGruppeModal").modal();
            $("#editGruppeId").val(0);
            $.ajax({
                url: 'snippets/retrieveSingleGruppe.php',
                type: 'post',
                data: {rid: id},
                dataType: 'json',
                success: function (response) {
                    document.getElementById("editGruppeBetreuer").innerHTML = "";

                    JSON.parse(betreuer).forEach(function (data, index) {
                        if(response.name.includes(data.name))
                            $("#editGruppeBetreuer").append("<option selected value='" + data.id + "'" + ">" + data.name + "</option>");
                        else
                            $("#editGruppeBetreuer").append("<option value='" + data.id + "'" + ">" + data.name + "</option>");
                    });

                    $("#editGruppeGruppenname").val(response.Gruppennummer);
                    $("#editGruppeRaum").val(response.Raum);
                    $("#editGruppeWochentag").val(response.Wochentag);
                    $("#editGruppeUhrzeit").val(response.Uhrzeit);
                    $("#editGruppeId").val(response['ID']);
                    $("#editGruppeForm").unbind("submit").bind("submit", function () {
                        var form = $(this);
                        var id = $("#editGruppeId").val();
                        var gruppenname = $("#editGruppeGruppenname").val();
                        var raum = $("#editGruppeRaum").val();
                        var wochentag = $("#editGruppeWochentag").val();
                        var uhrzeit = $("#editGruppeUhrzeit").val();
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            success: function (response) {
                                $tablegruppen.bootstrapTable("updateByUniqueId", {
                                    id: id,
                                    row: {
                                        id: id,
                                        gruppenname: gruppenname,
                                        raum: raum,
                                        wochentag: wochentag,
                                        betreuer: JSON.parse(response),
                                        uhrzeit: uhrzeit
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
    });
}