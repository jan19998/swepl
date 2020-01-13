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

if(!mysqli_error($db->getConnection())) {
    $id = mysqli_insert_id($db->getConnection());
    mysqli_query($db->getConnection(), "insert into betreut(Benutzer_FK, Gruppe_FK) values('$id', '$gruppe')");
    $gruppe = mysqli_fetch_all(mysqli_query($db->getConnection(), "select Gruppennummer from gruppe where ID='$gruppe'"), MYSQLI_ASSOC);
    echo json_encode(array("id" => $id, "gruppe" => $gruppe[0]['Gruppennummer']));
}

$db->close();