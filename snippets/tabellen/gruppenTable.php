<div class="none" id="gruppenTable">
    <div id="gruppetoolbar" class="ml-3">
        <button type="button" id="createGruppeButton" class="btn" data-toggle="modal"
                data-target="#createGruppeModal">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <table
        id="tablegruppen"
        data-locale="de-DE"
        data-search="true"
        data-toggle="table"
        data-toolbar="#gruppetoolbar"
        data-detail-view="true"
        data-toolbar-align="right"
        data-detail-formatter="detailGruppeFormatter"
        data-pagination="true"
        data-unique-id="id"
        data-page-list="[10, 25, 50, 100, all]">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="gruppenname" data-sortable="true">Gruppenname</th>
            <th data-field="termine" data-visible="false">Termine</th>
            <th data-field="raum">Raum</th>
            <th data-field="uhrzeit">Uhrzeit</th>
            <th data-field="wochentag">Wochentag</th>
            <th data-field="betreuer" data-visible="false">Betreuer</th>
            <th data-field="studenten" data-visible="false">Studenten</th>
            <th data-field="operate" data-formatter="operateGruppeFormatter"
                data-events="window.operateGruppeEvents">Aktion
            </th>
        </tr>
        </thead>
    </table>
</div>