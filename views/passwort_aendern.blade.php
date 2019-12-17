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
        <?php include('snippets/header.php');
        if(!isset($_SESSION['rolle'])){
            header("Location: startseite.php");
        }
        ?>
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
            <?php include('snippets/footer.php');?>
    </div>
</body>
</html>
