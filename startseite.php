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
</head>

<body>
<div class ="container">
    <?php include('snippets/header_startseite.php.');?>

    <div class ="row justify-content-center" id="Überschrift" >
        <div class=col-12">
            <h4>
                Das neue Tool zur Verwaltung von Praktikumsgruppen des "Software Engineering" Moduls
            </h4>
        </div>
    </div>


    <?php
    if(isset($errorMessage)) {
        echo $errorMessage;
    }
    ?>

    <div class="row justify-content-center" id="inhalt">
        <div class="col-3">
        <?php include('snippets/login.php')?>
        </div>
        <div class="col-9">
            <!--Inhalt 1-->
            <!-- Beschreibung -->
           <div class="row">
                   <p>Nutzen Sie jetzt den Planungs- und Organisationsdienst für das Software Engineering Praktikum der FH Aachen.</p>
           </div>
            <div class="row">
                    <p> Das Tool bietet Dozierenden und Betreuern von Praktikumsgruppen eine Bandbreite von Funktionen, die die Planung und Verwaltung der einzelnen Projekte erheblich erleichtern.</p>
            </div>
            <div class="row">
                    <img src="pictures/swe.jpg"    id="swepicture" alt="SWE" class="img-fluid" >

            </div>

        </div>


    </div>

</div>

<!-- Damit Footer immer unten in der Mitte ist-->
<div class="row justify-content-center">
    <?php include('snippets/footer_startseite.php');
    //var_dump(password_hash('PasswortChangeTest',PASSWORD_BCRYPT));
    //var_dump(password_verify('PasswortChangeTest','$2y$10$Wi0c07wtW6yIDtO.Mmdc9.XI5FFVoEu6a2rr4xOBhm.pY/jXFBrE2'));?>
</div>
</body>
</html>




