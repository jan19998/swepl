function detailBetreuerFormatter(index, row) {
    return 'Benutzername: ' + row['benutzername'] + '<br>'
        + 'Nachname: ' + row['nachname'] + '<br>'
        + 'Vorname: ' + row['vorname'] + '<br>'
        + 'Gruppe: ' + row['gruppe'] + '<br>'
        + 'E-Mail: ' + row['email'];
}

function operateBetreuerFormatter(value, row, index) {
    return [
        '<a class="betreuerEdit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-pen"></i>',
        '</a>  ',
        '<a class="betreuerRemove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateBetreuerEvents = {
    'click .betreuerEdit': function (e, value, row, index) {
        editBetreuer(row['id']);
    },
    'click .betreuerRemove': function (e, value, row, index) {
        delBetreuer(row['id']);
    }
};

$(document).ready()
{

    $("#createBetreuerButton").on("click", function () {
        $("#createBetreuerForm")[0].reset();
        $("#createBetreuerForm").unbind("submit").bind("submit", function () {
            var form = $(this);
            var passwort = $("#createBetreuerPasswort").val();
            var benutzername = $("#createBetreuerBenutzername").val();
            var nachname = $("#createBetreuerNachname").val();
            var vorname = $("#createBetreuerVorname").val();
            var email = $("#createBetreuerEmail").val();
            var gruppe = $("#createBetreuerGruppe").val();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    $tablebetreuer.bootstrapTable('insertRow', {
                        index: 0,
                        row: {
                            id: response,
                            benutzername: benutzername,
                            vorname: vorname,
                            nachname: nachname,
                            gruppe: gruppe,
                            email: email
                        }
                    });
                    $("#createBetreuerForm")[0].reset();
                    $("#createBetreuerModal").modal("hide");
                }
            });
            return false;
        });
    });

}

function delBetreuer(id = null) {
    $("#deleteModal").modal();
    $("#deletesubmit").unbind("click").bind("click", function () {
        $.ajax({
            url: "snippets/deleteBetreuer.php",
            type: "POST",
            data: {did: id},
            success: function () {
                $tablebetreuer.bootstrapTable("removeByUniqueId", id);
                $("#deleteModal").modal("hide");
            }
        });
    });
}

function editBetreuer(id = null) {
    $("#editBetreuerModal").modal();
    $("#editBetreuerId").val(0);
    $.ajax({
        url: 'snippets/retrieveSingleBetreuer.php',
        type: 'post',
        data: {rid: id},
        dataType: 'json',
        success: function (response) {
            $("#editBetreuerNachname").val(response.Nachname);
            $("#editBetreuerVorname").val(response.Vorname);
            $("#editBetreuerGruppe").val("");
            $("#editBetreuerEmail").val(response['E-Mail']);
            $("#editBetreuerId").val(response['ID']);
            $("#editBetreuerBenutzername").val(response.Benutzer);
            $("#editBetreuerForm").unbind("submit").bind("submit", function () {
                var form = $(this);
                var id = $("#editBetreuerId").val();
                var nachname = $("#editBetreuerNachname").val();
                var vorname = $("#editBetreuerVorname").val();
                var email = $("#editBetreuerEmail").val();
                var gruppe = $("#editBetreuerGruppe").val();
                var benutzername = $("#editBetreuerBenutzername").val();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function () {
                        $tablebetreuer.bootstrapTable("updateByUniqueId", {
                            id: id,
                            row: {
                                benutzername: benutzername,
                                nachname: nachname,
                                vorname: vorname,
                                email: email,
                                gruppe: gruppe
                            }
                        });
                        $("#editBetreuerModal").modal("hide");
                    }
                });
                return false;
            });
        }
    });
}