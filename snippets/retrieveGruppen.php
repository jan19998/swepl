<?php
session_start();
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;



$query = "SELECT g.ID id, g.Gruppennummer gruppenname, g.Wochentag wochentag, g.Uhrzeit uhrzeit, g.Raum raum, group_concat(distinct concat(ben.Vorname, ' ', ben.Nachname)) betreuer,
    group_concat(distinct s.Vorname) studenten, group_concat(distinct t.Datum) termine
    from gruppe g
    LEFT join betreut bet on bet.Gruppe_FK=g.ID
    left join benutzer ben on bet.Benutzer_FK=ben.ID
    left JOIN Student s ON s.Gruppe_FK=g.ID
    left join termin t on t.Gruppe_FK=g.ID
    WHERE g.Semester_FK='$jahr'
    GROUP BY g.ID";
$result = mysqli_query($db->getConnection(), $query);
$gruppen = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($gruppen);