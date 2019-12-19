<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$benutzer = $_POST['createBetreuerBenutzername'];
$passwort = password_hash($_POST['createBetreuerPasswort'], PASSWORD_BCRYPT);
$vorname = $_POST['createBetreuerVorname'];
$nachname = $_POST['createBetreuerNachname'];
$email = $_POST['createBetreuerEmail'];
$gruppe = $_POST['createBetreuerGruppe'];
$semester = $_SESSION['jahr'];

$query = "insert into benutzer(Vorname, Nachname, `E-Mail`, Passwort, Benutzer, Semester_FK)
    values('$vorname', '$nachname', '$email', '$passwort', '$benutzer', '$semester')";

mysqli_query($db->getConnection(), $query);

if(!mysqli_error($db->getConnection()))
    echo mysqli_insert_id($db->getConnection());

$db->close();