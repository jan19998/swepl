<?php
require_once "dbconnect.php";

$db = new dbconnect();

$jahr = $_POST['rjahr'];
$_SESSION['jahr'] = $jahr;

$result = mysqli_query($db->getConnection(), "Select ID id, Nachname nachname, Vorname vorname, `E-Mail` email, Benutzer benutzername
    from benutzer where IstDozent=0");
$betreuer = mysqli_fetch_all($result, MYSQLI_ASSOC);

$db->close();

echo json_encode($betreuer);