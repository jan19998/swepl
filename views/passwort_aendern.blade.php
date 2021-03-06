<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>SWEPl</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row pb-3">
                <div class="col-11">
                    <a href="startseite.php">
                        <img class="logo img-fluid" alt="SWEpl Logo" src="pictures/swepl.png" width="100" height="100">
                    </a>
                </div>
                <div class="col-1 align-self-center justify-content-end ">
                    <form action="Logout.php">
                        <button class="btn" type="submit" value="logout">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <?php //include('snippets/header.php');
        if(!isset($_SESSION['rolle'])){
            header("Location: startseite.php");
        }
        ?>
        <div class ="row pb-3">
            <div class ="col-9">
            </div>
            <div class="col-3 justify-content-end" style="justify-content: flex-end;">
                <a href="jahresauswahl.php" class="btn border-0 btn-primary">Zurück zur Kursübersicht</a>
            </div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="passwort_aendern_controller.php" method="POST">
                    <legend>Passwort ändern</legend>
                    <div class="form-group">
                        <input type="password" class="form-control" aria-describedby="wrong_password" name="new_password" placeholder="Neues Passwort...">
                        @if(isset($fehlermeldungen))
                            @for($i=0;$i<count($fehlermeldungen);$i++)
                                @if($fehlermeldungen[$i]=='Sie müssen ein neues Passwort wählen.')
                                    <small id ="wrong_password" class="form-text text-muted" style="color:red!important;">Wählen Sie ein neues Passwort.</small>
                                @endif
                            @endfor
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" aria-describedby="unequal_passwords" name="new_password_confirmation" placeholder="Passwort wiedeholen...">
                        @if(isset($fehlermeldungen))
                            @for($i=0;$i<count($fehlermeldungen);$i++)
                                @if($fehlermeldungen[$i]=='Die Passwörter müssen gleich sein.')
                                    <small id ="wrong_password" class="form-text text-muted" style="color:red!important;">Die Passwörter müssen gleich sein.</small>
                                @endif
                            @endfor
                        @endif
                    </div>
                    <button type="submit" class ="btn border-0 btn-primary">Daten abschicken</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <footer>
            <div class="row justify-content-center pt-3">
                <div class="col justify-content-center">
                    <ul class="list-group list-group-horizontal justify-content-center">
                        <li class="list-group-item border-left-0 border-top-0 border-bottom-0 border-right-0"><a class="link" href="https://www.fh-aachen.de/Impressum" target="_blank" rel="noopener noreferrer">Impressum & Datenschutz</a></li>
                        <li class="list-group-item border-top-0 border-bottom-0 border-right-0"><a class="link" href="https://www.fh-aachen.de/" target="_blank" rel="noopener noreferrer">FH-Aachen</a></li>
                        <li class="list-group-item border-top-0 border-bottom-0 border-right-0"><a class="link" href="passwort_aendern_controller.php">Passwort ändern</a></li>
                    </ul>
                </div>
            </div>
        </footer>
            <?php //include('snippets/footer.php');?>
    </div>
</body>
</html>
