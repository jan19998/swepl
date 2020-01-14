<div class="none" id="termineTable">
    <div id="termintoolbar" class="ml-3">
        <button type="button" id="createTerminButton" class="btn" data-toggle="modal"
                data-target="#createTerminModal">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <table
            id="tabletermine"
            data-locale="de-DE"
            data-search="true"
            data-toggle="table"
            data-pagination="true"
            data-unique-id="id"
            data-page-list="[10, 25, 50, 100, all]"
            data-toolbar="#termintoolbar"
            data-toolbar-align="right">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="gruppe">Gruppe</th>
            <th data-field="datum">Datum</th>
            <th data-field="operate" data-formatter="operateTerminFormatter"
                data-events="window.operateTerminEvents">Aktion
            </th>
        </tr>
        </thead>
    </table>
</div>