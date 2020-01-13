function operateTerminFormatter(value, row, index) {
    return [
        '<a class="terminRemove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateTerminEvents = {
    'click .terminRemove': function (e, value, row, index) {
        delTermin(row['id']);
    }
};

$(document).ready()
{

    $("#createTerminButton").on("click", function () {
        $.ajax({
            url: "snippets/retrieveGruppenname.php",
            type: "post",
            success: function (gruppen) {
                document.getElementById("createTerminGruppe").innerHTML = "";

                JSON.parse(gruppen).forEach(function (data, index) {
                    $("#createTerminGruppe").append("<option value='" + data.ID + "'" + ">" + data.Gruppennummer + "</option>");
                });

                $("#createTerminForm")[0].reset();
                $("#createTerminForm").unbind("submit").bind("submit", function () {
                    var form = $(this);
                    var datum = $("#createTerminDatum").val();
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $tabletermine.bootstrapTable('insertRow', {
                                index: 0,
                                row: {
                                    id: response.id,
                                    gruppe: response.gruppe,
                                    datum: datum.replace('T', ' ') + ':00'
                                }
                            });
                            $("#createTerminForm")[0].reset();
                            $("#createTerminModal").modal("hide");
                        }
                    });
                    return false;
                });
            }
        });
    });

}

function delTermin(id = null) {
    $("#deleteModal").modal();
    $("#deletesubmit").unbind("click").bind("click", function () {
        $.ajax({
            url: "snippets/deleteTermin.php",
            type: "POST",
            data: {did: id},
            success: function () {
                $tabletermine.bootstrapTable("removeByUniqueId", id);
                $("#deleteModal").modal("hide");
            }
        });
    });
}