<?php
$error=''; //Um die Error message zu speichern;
if(isset($_POST['submit'])){
    if(empty($_POST['email']) || empty($_POST['passwort'])){
        $error = "Falsches Passwort";
    }
    else
    {
        //Variable für Email und Passwort erstellen
        $user=$_POST['email'];
        $pass=$_POST['passwort'];

        //Datenbankverbindung herstellen
        $remoteConnection = mysqli_connect("127.0.0.1", "root", "", "swepl");
        //Datenbank auswählen
        $db = mysqli_select_db($remoteConnection, "swepl");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($remoteConnection, "SELECT * FROM swepl.benutzer WHERE `E-Mail`='$user' AND Passwort='$pass'");

        $rows = mysqli_num_rows($query);
        if($rows == 1){
            header("Location: jahresauswahl.php"); // Zur Betreuer Seite weitelreiten

            //************************************************************************
            //Hier fehlt noch die Unterscheidung zwischen Betreuer und Dozent
        }
        else
        {
            $error = "Passwort ungültig";
        }
        mysqli_close($remoteConnection); // Verbindung wieder beenden
    }
}

?>

