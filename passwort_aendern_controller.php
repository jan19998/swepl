<?php
Use eftec\bladeone\BladeOne;
session_start(); //Wird schon in Header gestartet
require __DIR__. '/vendor/autoload.php';
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
if(isset($_POST['new_password']) and $_POST['new_password'] != "" and isset($_POST['new_password_confirmation']) and $_POST['new_password_confirmation'] != "") {
    $new_passwort = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $email = $_SESSION['user'];
    $old_password = null;
    $fehlermeldungen = array();
    $remoteConnection = mysqli_connect(
        "127.0.0.1", "root", "", "swepl"
    );

    if ($_POST['new_password'] != $_POST['new_password_confirmation']) {
        array_push($fehlermeldungen, 'Die Passwörter müssen gleich sein.');
    }
    if (($_POST['new_password'] == $_POST['new_password_confirmation'])) {
        mysqli_autocommit($remoteConnection,false);
        $query1 = "UPDATE Benutzer SET Passwort = '$new_passwort' where `E-Mail` = '$email'; ";
        mysqli_query($remoteConnection, $query1);
        if(!mysqli_commit($remoteConnection)) {
            mysqli_rollback($remoteConnection);
            echo 'Fehler beim Ändern des Passwortes.';
        }
        else {
            mysqli_commit($remoteConnection);
        }
        $blade = new BladeOne();
        echo $blade->run("password_change_successful");
    } else {
        $blade = new BladeOne();
        echo $blade->run("passwort_aendern", ['fehlermeldungen' => $fehlermeldungen]);
    }
}
else {
    $blade=new BladeOne();
    echo $blade->run("passwort_aendern");
}
?>