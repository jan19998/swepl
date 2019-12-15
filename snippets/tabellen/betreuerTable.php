<div style="display: none" id="betreuerTable">
    <div id="betreuertoolbar" class="ml-3">
        <button type="button" id="createBetreuerButton" class="btn" data-toggle="modal"
                data-target="#createBetreuerModal">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <table
        id="tablebetreuer"
        data-search="true"
        data-toggle="table"
        data-toolbar="#betreuertoolbar"
        data-detail-view="true"
        data-toolbar-align="right"
        data-detail-formatter="detailBetreuerFormatter"
        data-pagination="true"
        data-unique-id="id"
        data-page-list="[10, 25, 50, 100, all]">
        <thead>
        <tr>
            <th data-field="id" data-sortable="true" data-visible="false">ID</th>
            <th data-field="benutzername" data-sortable="true">Benutzername</th>
            <th data-field="nachname" data-sortable="true">Nachname</th>
            <th data-field="vorname" data-sortable="true">Vorname</th>
            <th data-field="gruppe" data-sortable="true">Gruppe</th>
            <th data-field="email" data-visible="false">E-Mail</th>
            <th data-field="operate" data-formatter="operateBetreuerFormatter"
                data-events="window.operateBetreuerEvents">Operate
            </th>
        </tr>
        </thead>

    </table>
</div>