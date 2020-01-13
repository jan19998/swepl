<?php
require_once "snippets/dbconnect.php";
$db = new dbconnect();
$result = mysqli_query($db->getConnection(), "select * from meilenstein_global");
$meilensteine = mysqli_fetch_all($result, MYSQLI_ASSOC);
$db->close();
?>

<div id="meilensteineTable">
    <div id="meilensteintoolbar" class="ml-3">
        <button type="button" id="createMeilensteinButton" class="btn" data-toggle="modal"
                data-target="#createMeilensteinModal">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <table
            id="tablemeilensteine"
            data-locale="de-DE"
            data-search="true"
            data-toggle="table"
            data-toolbar="#meilensteintoolbar"
            data-detail-view="true"
            data-toolbar-align="right"
            data-detail-formatter="detailMeilensteinFormatter"
            data-pagination="true"
            data-unique-id="id"
            data-page-list="[10, 25, 50, 100, all]">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="meilenstein">Meilenstein</th>
            <th data-field="frist">Fälligkeitsdatum</th>
            <th data-field="beschreibung" data-visible="false">Beschreibung</th>
            <th data-field="semester">Semester</th>
            <th data-field="operate" data-formatter="operateMeilensteinFormatter"
                data-events="window.operateMeilensteinEvents">Bearbeiten
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($meilensteine as $meilenstein) { ?>
            <tr>
                <td><?php echo $meilenstein['ID'] ?></td>
                <td><?php echo $meilenstein['Bezeichnung'] ?></td>
                <td><?php echo $meilenstein['Frist'] ?></td>
                <td><?php echo $meilenstein['Beschreibung'] ?></td>
                <td><?php echo $meilenstein['Semester_FK'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>