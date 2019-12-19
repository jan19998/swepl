<?php
require_once "snippets/dbconnect.php";
$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "Select kennung jahr from semester order by Kennung");
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
        data-locale="de-DE"
        data-toggle="table"
        data-unique-id="jahr"
        data-toolbar="#jahrtoolbar"
        data-toolbar-align="right">
    <thead>
    <tr>
        <th data-field="jahr" data-formatter="dropdownJahrFormatter">Jahre</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($semester as $s) { ?>
        <tr>
            <td>
                <?php echo $s['jahr']; ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>