<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <title>SWEPl</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/swepl.css">

    <meta http-equiv="refresh" content="3; URL=startseite.php">
</head>
<body>
<div class="container">
        <div class="row pb-3">
            <div class="col-11">
                <a href="startseite.php">
                    <img class="logo img-fluid" alt="SWEpl Logo" src="pictures/swepl.png" width="100" height="100">
                </a>
            </div>
            <div class="col-1 align-self-center justify-content-end ">
                <!--empty-->
            </div>
        </div>
        <h1>Auf Wiedersehen!</h1>
        <?php
        session_start();
        session_destroy();
        ?>
        <footer>
            <div class="row justify-content-center pt-3">
                <div class="col justify-content-center">
                    <ul class="list-group list-group-horizontal justify-content-center">
                        <li class="list-group-item border-left-0 border-top-0 border-bottom-0 border-right-0"><a class="link" href="#">Impressum & Datenschutz</a></li>
                        <li class="list-group-item border-top-0 border-bottom-0 border-right-0"><a class="link" href="https://www.fh-aachen.de/" target="_blank" rel="noopener noreferrer">FH-Aachen</a></li>
                    </ul>
                </div>
            </div>
        </footer>
</div>
</body>