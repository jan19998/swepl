<!-- Modal -->
<div id="createJahrModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertJahr.php" method="post" id="createJahrForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createJahr">Jahr</label>
                        <input class="mt-2 form-control col mr-3" type="text" id="createJahr"
                               name="createJahr" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createJahrSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="deleteJahrModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Löschen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/deleteJahr.php" method="post" id="deleteJahrForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="deleteJahrSelect" id="deleteJahrSelectLabel">Jahr</label>
                        <select class="mt-2 form-control col mr-3" id="deleteJahrSelect" name="deleteJahrSelect" required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="deleteJahrSubmit">Löschen
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>