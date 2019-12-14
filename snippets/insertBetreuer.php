<?php
require_once "dbconnect.php";
$db = new dbconnect();

$benutzer = $_POST['createBetreuerBenutzername'];
$passwort = $_POST['createBetreuerPasswort'];
$vorname = $_POST['createBetreuerVorname'];
$nachname = $_POST['createBetreuerNachname'];
$email = $_POST['createBetreuerEmail'];
$gruppe = $_POST['createBetreuerGruppe'];

$query = "insert into benutzer(Vorname, Nachname, `E-Mail`, Passwort, Benutzer)
    values('$vorname', '$nachname', '$email', '$passwort', '$benutzer')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();