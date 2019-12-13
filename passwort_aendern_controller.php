<?php
Use eftec\bladeone\BladeOne;
require __DIR__. '/vendor/autoload.php';
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
if(isset($_POST['new_password']) and $_POST['new_password'] != "" and isset($_POST['new_password_confirmation']) and $_POST['new_password_confirmation'] != "") {
    $new_passwort = password_hash($_POST['new_password'],PASSWORD_BCRYPT);
    //$email = $_SESSION['email'];
    $old_password = null;
    $fehlermeldungen = array();
    $remoteConnection = mysqli_connect(
        "127.0.0.1", "root","","swepl"
    );
    $query = "SELECT Passwort from Benenutzer where `E-Mail` = 'email';";
    if($result = mysqli_query($remoteConnection,$query)) {
        while($row=mysqli_fetch_assoc($result)) {
            $old_password = $row['Passwort'];
        }
    }
    /*
    if(passwort_verfiy($_POST['new_password'],$old_password)) {
        array_push($fehlermeldungen,'
    ');
    }*/
    if($_POST['new_password'] != $_POST['new_password_confirmation']) {
        array_push($fehlermeldungen,'Die Passwörter müssen gleich sein.');
    }
    if(($_POST['new_password'] == $_POST['new_password_confirmation']) /*and !(passwort_verfiy($_POST['new_password'],$old_password))*/) {
        $query1 = "UPDATE Benutzer SET Passwort = '$new_passwort' where `E-Mail` = '$email'; " ;
        mysqli_query($remoteConnection,$query1);
        $blade=new BladeOne();
        echo $blade->run("password_change_successful");
    }
    else {
        $blade=new BladeOne();
        echo $blade->run("passwort_aendern" ,['fehlermeldungen'=>$fehlermeldungen]);
    }
}
else {
    $blade=new BladeOne();
    echo $blade->run("passwort_aendern");
}
?>