<!-- Modal -->
<div id="createMeilensteinModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertMeilenstein.php" method="post" id="createMeilensteinForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createMeilenstein">Meilenstein</label>
                        <input class="mt-2 form-control col mr-3" type="text" id="createMeilenstein"
                               name="createMeilenstein" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createMeilensteinFrist">Frist</label>
                        <input class="mt-1 form-control col mr-3" type="date" id="createMeilensteinFrist"
                               name="createMeilensteinFrist">
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createMeilensteinSemester">Semester</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createMeilensteinSemester"
                               name="createMeilensteinSemester">
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="createMeilensteinBeschreibung">Beschreibung</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="createMeilensteinBeschreibung"
                               name="createMeilensteinBeschreibung">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createMeilensteinSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editMeilensteinModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bearbeiten</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/updateMeilenstein.php" method="post" id="editMeilensteinForm">
                <div class="modal-body">
                    <input type="hidden" id="editMeilensteinId" name="editMeilensteinId">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="editMeilenstein">Meilenstein</label>
                        <input class="mt-2 form-control col mr-3" type="text" id="editMeilenstein"
                               name="editMeilenstein" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editMeilensteinFrist">Frist</label>
                        <input class="mt-1 form-control col mr-3" type="date" id="editMeilensteinFrist"
                               name="editMeilensteinFrist">
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editMeilensteinSemester">Semester</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editMeilensteinSemester"
                               name="editMeilensteinSemester">
                    </div>
                    <div class="row form-group">
                        <label class="mt-1 col-4" for="editMeilensteinBeschreibung">Beschreibung</label>
                        <input class="mt-1 form-control col mr-3" type="text" id="editMeilensteinBeschreibung"
                               name="editMeilensteinBeschreibung">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="editMeilensteinSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>