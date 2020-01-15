<?php
session_start();
require_once "dbconnect.php";
$db = new dbconnect();

$benutzer = $_POST['createBetreuerBenutzername'];
$passwort = password_hash($_POST['createBetreuerPasswort'], PASSWORD_BCRYPT);
$vorname = $_POST['createBetreuerVorname'];
$nachname = $_POST['createBetreuerNachname'];
$email = $_POST['createBetreuerEmail'];
$semester = $_SESSION['jahr'];

$query = "insert into benutzer(Vorname, Nachname, `E-Mail`, Passwort, Benutzer, Semester_FK)
    values('$vorname', '$nachname', '$email', '$passwort', '$benutzer', '$semester')";

echo mysqli_query($db->getConnection(), $query);

$db->close();