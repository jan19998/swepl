<?php
session_start();

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
        //Datenbank nach eingegebener Email und Passwort durchsuchen
        $query = mysqli_query($remoteConnection, "SELECT * FROM swepl.benutzer WHERE `E-Mail`='$user' AND Passwort='$pass'");


        //Wenn ein passender Eintrag gefunden wird ist Anzahl der rows ==1
        //************************************************************************
        //Hier fehlt noch die Unterscheidung zwischen Betreuer und Dozent
        $Dozent = mysqli_fetch_object($query); //Variable um auf "IstDozent" von Benutzer zuzugreifen
        $rows = mysqli_num_rows($query);

        //Unterscheidung zwischen Dozent und Betreuer
        if($rows == 1 && $Dozent->IstDozent == 0) { //Bedingung noch nicht korrekt?
            //Session registrieren
            //Wir speichern die eingegebene Email-Adresse als Session Variable in 'user' ab
            $_SESSION['user'] = $_POST['email'];
            header("Location: jahresauswahl.php"); // Zur Betreuer Seite weitelreiten
        }

        else if ($rows == 1 && $Dozent->IstDozent == 1){
           $_SESSION['user'] = $_POST['email'];
            header("Location: dozent.php");
        }
        else
        {
            $error = "Passwort ungültig";
        }
        mysqli_close($remoteConnection); // Verbindung wieder beenden
    }
}

?>

