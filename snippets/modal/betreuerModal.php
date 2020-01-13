<!-- Modal -->
<div id="createBetreuerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertBetreuer.php" method="post" id="createBetreuerForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createBetreuerBenutzername">Benutzername</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createBetreuerBenutzername"
                               name="createBetreuerBenutzername" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createBetreuerNachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createBetreuerNachname"
                               name="createBetreuerNachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createBetreuerVorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createBetreuerVorname"
                               name="createBetreuerVorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createBetreuerGruppe">Gruppe</label>
                        <select class="mt-1 form-control col mr-3" id="createBetreuerGruppe"
                                name="createBetreuerGruppe"></select>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="createBetreuerEmail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="createBetreuerEmail"
                               name="createBetreuerEmail" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="createBetreuerPasswort">Passwort</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="text" id="createBetreuerPasswort"
                               name="createBetreuerPasswort" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createBetreuerSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editBetreuerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bearbeiten</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/updateBetreuer.php" method="post" id="editBetreuerForm">
                <div class="modal-body">
                    <input type="hidden" id="editBetreuerId" name="editBetreuerId">
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editBetreuerBenutzername">Benutzername</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editBetreuerBenutzername"
                               name="editBetreuerBenutzername" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editBetreuerNachname">Nachname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editBetreuerNachname"
                               name="editBetreuerNachname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editBetreuerVorname">Vorname</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editBetreuerVorname"
                               name="editBetreuerVorname" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editBetreuerGruppe">Gruppe</label>
                        <select class="mt-1 form-control col mr-3" id="editBetreuerGruppe"
                                name="editBetreuerGruppe"></select>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 mb-2 col-4" for="editBetreuerEmail">E-Mail</label>
                        <input class="mt-1 mb-2 form-control col mr-3" type="email" id="editBetreuerEmail"
                               name="editBetreuerEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="editBetreuerSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>