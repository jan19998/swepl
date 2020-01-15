<!-- Modal -->
<div id="createGruppeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertGruppe.php" method="post" id="createGruppeForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createGruppeGruppenname">Gruppenname</label>
                        <input class="mt-2 form-control col mr-3" type="text" id="createGruppeGruppenname"
                               name="createGruppeGruppenname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createGruppeRaum">Raum</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createGruppeRaum"
                               name="createGruppeRaum" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createGruppeUhrzeit">Uhrzeit</label>
                        <input class="mt-1 form-control col mr-3" type="time" id="createGruppeUhrzeit"
                               name="createGruppeUhrzeit" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createGruppeWochentag">Wochentag</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createGruppeWochentag"
                               name="createGruppeWochentag" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createGruppeBetreuer">Wochentag</label>
                        <select class="mt-1 form-control col mr-3" id="createGruppeBetreuer"
                                name="createGruppeBetreuer[]" multiple required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createGruppeSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editGruppeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bearbeiten</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/updateGruppe.php" method="post" id="editGruppeForm">
                <div class="modal-body">
                    <input type="hidden" id="editGruppeId" name="editGruppeId">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="editGruppeGruppenname">Gruppenname</label>
                        <input class="mt-2 form-control col mr-3" type="text" id="editGruppeGruppenname"
                               name="editGruppeGruppenname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editGruppeRaum">Raum</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editGruppeRaum"
                               name="editGruppeRaum" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editGruppeUhrzeit">Uhrzeit</label>
                        <input class="mt-1 form-control col mr-3" type="time" id="editGruppeUhrzeit"
                               name="editGruppeUhrzeit" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editGruppeWochentag">Wochentag</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editGruppeWochentag"
                               name="editGruppeWochentag" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editGruppeBetreuer">Wochentag</label>
                        <select class="mt-1 form-control col mr-3" id="editGruppeBetreuer"
                                name="editGruppeBetreuer[]" multiple required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="editGruppeSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>