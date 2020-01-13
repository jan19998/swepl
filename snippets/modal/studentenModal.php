<!-- Modal -->
<div id="createStudentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertStudent.php" method="post" id="createStudentForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createStudentMatrikel">Matrikelnummer</label>
                        <input class="mt-2 form-control col mr-3" type="number" id="createStudentMatrikel"
                               name="createStudentMatrikel" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createStudentNachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createStudentNachname"
                               name="createStudentNachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createStudentVorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createStudentVorname"
                               name="createStudentVorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createStudentGruppe">Gruppe</label>
                        <select class="mt-1 form-control col mr-3" id="createStudentGruppe"
                                name="createStudentGruppe" required>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="createStudentEmail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="createStudentEmail"
                               name="createStudentEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createStudentSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editStudentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bearbeiten</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/updateStudent.php" method="post" id="editStudentForm">
                <div class="modal-body">
                    <input type="hidden" id="editStudentId" name="editStudentId">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="editStudentMatrikel">Matrikelnummer</label>
                        <input class="mt-2 form-control col mr-3" type="number" id="editStudentMatrikel"
                               name="editStudentMatrikel" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editStudentNachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editStudentNachname"
                               name="editStudentNachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editStudentVorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editStudentVorname"
                               name="editStudentVorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editStudentGruppe">Gruppe</label>
                        <select class="mt-1 form-control col mr-3" id="editStudentGruppe"
                                name="editStudentGruppe" required>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="editStudentEmail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="editStudentEmail"
                               name="editStudentEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="editStudentSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>