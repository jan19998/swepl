<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <title>SWEPl</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="swepl.css">
</head>

<body>
<?php include header?>
<div class ="container">
    <div class ="row">
        <div class ="col-3 logo">
            <img src="116986.jpg" alt="Logo">
        </div>
    </div>
    <div class ="row">
        <div class ="col-3 aktuell_ausgewaelte_gruppe">
            <h3>
                <?php echo aktuell_ausgewählte_gruppe?>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class ="col-3 meilenstein_navigation">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">Terminübersicht</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Kursteilnehmer</a>
                <a class="nav-link active" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="true">Meilensteine</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Statistiken</a>
            </div>
        </div>
        <div class ="col-9 contens_meilenstein">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                <div class="tab-pane fade show active" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <table class ="meilenstein_erreichungs_tabelle">
                        <thead>
                        <td>
                            Frist
                        </td>
                        <td>
                            Ereignis
                        </td>
                        <td>
                            Erreichung
                        </td>
                        </thead>
                        while_schleife(fetch_assoc) {
                        <tr>
                            <td>
                                Frist
                            </td>
                            <td>
                                Ereignis
                            </td>
                            <td>
                                Erreichung
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Frist
                            </td>
                            <td>
                                Ereignis
                            </td>
                            <td>
                                Erreichung
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Frist
                            </td>
                            <td>
                                Ereignis
                            </td>
                            <td>
                                Erreichung
                            </td>
                        </tr>
                        }
                    </table>
                    <form action="betreuer_meilenstein.php" method="post">
                        <fieldset class="meilenstein_bearbeiten">
                            <legend>Einträge bearbeiten</legend>
                            <div class ="row">
                                <div class ="col-9 eingabefelder_meilensteine">
                                    <select name = "meilenstein">
                                        <option>Meilenstein wählen...</option>
                                        <option>dynamisch erzeugen</option>
                                    </select>
                                </div>
                            </div>
                            <div class ="row">
                                <div class ="col-9 eingabefelder_meilensteine">
                                    <input type="date" name="meilenstein_erreicht" value="<?php echo date(d,m,Y);?>"/>
                                </div>
                            </div>
                            <div class ="row">
                                <div class ="col-9 eingabefelder_meilensteine">
                                    <input type="submit"/>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
    </div>
    </div>
    <?php include footer?>
</div>
</body>
</html>





