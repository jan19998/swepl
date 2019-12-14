<?php
require_once "snippets/dbconnect.php";
$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "Select * from semester order by Kennung");
$semester = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();
?>
<div id="jahrtoolbar" class="ml-3">
    <button type="button" id="createJahrButton" class="btn" data-toggle="modal"
            data-target="#createJahrModal">
        <i class="fa fa-plus"></i>
    </button>
</div>
<table
        id="tablejahre"
        data-toggle="table"
        data-toolbar="#jahrtoolbar"
        data-toolbar-align="right">
    <thead>
    <tr>
        <th data-field="jahr">Jahre</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($semester as $s) { ?>
        <tr>
            <td>
                <div class="btn-group dropright">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        <?php echo $s['Kennung']; ?>
                    </button>
                    <div class="dropdown-menu">
                        <button type="button" onclick="showStudenten('<?php echo $s['Kennung']; ?>')" class="dropdown-item">
                            Studenten
                        </button>
                        <button type="button" onclick="showGruppen('<?php echo $s['Kennung']; ?>')" class="dropdown-item">
                            Gruppen
                        </button>
                        <button type="button" onclick="showBetreuer('<?php echo $s['Kennung']; ?>')" class="dropdown-item">
                            Betreuer
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>