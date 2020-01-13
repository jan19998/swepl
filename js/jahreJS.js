function dropdownJahrFormatter(value, row, index) {
    return '<div class="btn-group dropright">'
        + '<button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'
        + row['jahr']
        + '</button>'
        + '<div class="dropdown-menu">'
        + '<button type="button" class="dropdown-item b" onclick="showStudenten('
        + "'"
        + row['jahr']
        + "'"
        + ')">'
        + 'Studenten'
        + '</button>'
        + '<button type="button" class="dropdown-item b" onclick="showGruppen('
        + "'"
        + row['jahr']
        + "'"
        + ')">'
        + 'Gruppen'
        + '</button>'
        + '<button type="button" class="dropdown-item b" onclick="showBetreuer('
        + "'"
        + row['jahr']
        + "'"
        + ')">'
        + 'Betreuer'
        + '</button>'
        + '<button type="button" class="dropdown-item b" onclick="showTermine('
        + "'"
        + row['jahr']
        + "'"
        + ')">'
        + 'Termine'
        + '</button>'
        + '</div>'
        + '</div>'
}

$(document).ready()
{

    $("#createJahrButton").on("click", function () {
        $("#createJahrForm")[0].reset();
        $("#createJahrForm").unbind("submit").bind("submit", function () {
            var form = $(this);
            var jahr = $("#createJahr").val();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function () {
                    $("#tablejahre").bootstrapTable('insertRow', {
                        index: 0,
                        row: {
                            jahr: jahr
                        }
                    });
                    $("#createJahrForm")[0].reset();
                    $("#createJahrModal").modal("hide");
                }
            });
            return false;
        });
    });

    $('#import').on('show.bs.tab', function (e) {
        $.ajax({
            url: "snippets/retrieveJahre.php",
            type: "get",
            success: function (response) {
                document.getElementById("semester").innerHTML = "";

                JSON.parse(response).forEach(function(data, index) {
                    $("#semester").append("<option>" + data.jahr + "</option>");
                });
            }
        });
    });

}

function deljahr() {
    $.ajax({
        url: "snippets/retrieveJahre.php",
        type: "get",
        success: function (response) {
            document.getElementById("deleteJahrSelect").innerHTML = "";

            JSON.parse(response).forEach(function(data, index) {
                $("#deleteJahrSelect").append("<option>" + data.jahr + "</option>");
            });

            $("#deleteJahrModal").modal();
            $("#deleteJahrForm").unbind("submit").bind("submit", function () {
                var form = $(this);
                var jahr = $("#deleteJahrSelect").val();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {djahr: jahr},
                    success: function () {
                        $("#tablejahre").bootstrapTable("removeByUniqueId", jahr);
                        $("#deleteJahrModal").modal("hide");
                    }
                });
                return false;
            });
        }
    });
}