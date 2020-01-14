<div class="none" id="studentenTable">
    <div id="studenttoolbar" class="ml-3">
        <button type="button" id="createStudentButton" class="btn" data-toggle="modal"
                data-target="#createStudentModal">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <table
        id="tablestudenten"
        data-search="true"
        data-toggle="table"
        data-locale="de-DE"
        data-toolbar="#studenttoolbar"
        data-detail-view="true"
        data-toolbar-align="right"
        data-detail-formatter="detailStudentFormatter"
        data-pagination="true"
        data-unique-id="id"
        data-page-list="[10, 25, 50, 100, all]">
        <thead>
        <tr>
            <th data-field="id" data-sortable="true" data-visible="false">ID</th>
            <th data-field="matrikelnummer" data-sortable="true">Matrikelnummer</th>
            <th data-field="nachname" data-sortable="true">Nachname</th>
            <th data-field="vorname" data-sortable="true">Vorname</th>
            <th data-field="gruppe" data-sortable="true">Gruppe</th>
            <th data-field="email" data-visible="false">E-Mail</th>
            <th data-field="operate" data-formatter="operateStudentFormatter"
                data-events="window.operateStudentEvents">Aktion
            </th>
        </tr>
        </thead>

    </table>
</div>