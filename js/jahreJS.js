$(document).ready()
{

    $("#createJahrButton").on("click", function () {
        $("#createJahrForm")[0].reset();
        $("#createJahrForm").unbind("submit").bind("submit", function () {
            var form = $(this);
            var jahr = $("#createJahrMatrikel").val();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function (response) {
                    var dropdown = JSON.stringify('<div class="btn-group dropright">'
                        + '<button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'
                        + jahr
                        + '</button>'
                        + '<div class="dropdown-menu">'
                        + '<button type="button" onclick="showStudenten(`'
                        + jahr
                        + '`)" class="dropdown-item">'
                        + 'Studenten'
                        + '</button>'
                        + '<button type="button" onclick="showGruppen(`'
                        + '`)" class="dropdown-item">'
                        + 'Gruppen'
                        + '</button>'
                        + '<button type="button" onclick="showBetreuer(`'
                        + '`)" class="dropdown-item">'
                        + 'Betreuer'
                        + '</button>'
                        + '</div>'
                        + '</div>');
                    $tablestudenten.bootstrapTable('insertRow', {
                        index: 0,
                        row: {
                            jahr: dropdown
                        }
                    });
                    $("#createJahrForm")[0].reset();
                    $("#createJahrModal").modal("hide");
                }
            });
            return false;
        });
    });

}