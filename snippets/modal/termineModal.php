<!-- Modal -->
<div id="createTerminModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="snippets/insertTermin.php" method="post" id="createTerminForm">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createTerminDatum">Datum</label>
                        <input class="mt-2 form-control col mr-3" type="datetime-local" id="createTerminDatum"
                               name="createTerminDatum" required>
                    </div>
                    <div class="row form-group">
                        <label class="mt-2 col-4" for="createTerminGruppe">Gruppe</label>
                        <select class="mt-2 form-control col mr-3" id="createTerminGruppe"
                                name="createTerminGruppe" required></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="createTerminSubmit">Speichern
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>