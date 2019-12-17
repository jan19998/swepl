<?php
session_start();

$error=null; //Um die Error message zu speichern;
if(isset($_SESSION['rolle']) and isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true)
{
    if($_SESSION['rolle'] == "Betreuer")
    {
        header("Location: jahresauswahl.php");
    }
    else if($_SESSION['rolle'] == "Dozent") {
        header("Location: dozent.php");
    }
}
if(isset($_POST['email']) and $_POST['email'] != "" and isset($_POST['passwort']) and $_POST['passwort'] != ""){

         //Variable für Email und Passwort erstellen
        $user=$_POST['email'];
        $password = $_POST['passwort'];
        //Datenbankverbindung herstellen
        $remoteConnection = mysqli_connect("127.0.0.1", "root", "", "swepl");
        //Datenbank auswählen
        $db = mysqli_select_db($remoteConnection, "swepl");
        //Datenbank nach eingegebener Email und Passwort durchsuchen
        $query = "SELECT * FROM swepl.benutzer WHERE `E-Mail`='$user'";
        $result = mysqli_query($remoteConnection,$query);
        //Wenn ein passender Eintrag gefunden wird ist Anzahl der rows ==1
        if($rows = mysqli_num_rows($result) == 1) {
            while($data = mysqli_fetch_assoc($result)) {
                $password_check = password_verify($password, $data['Passwort']);
                if($password_check) {
                    if($data['IstDozent'] == 0) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user'] = $_POST['email'];
                        $_SESSION['rolle'] = "Betreuer";
                        header("Location: jahresauswahl.php"); // Zur Betreuer Seite weiterleiten
                    }
                    else if($data['IstDozent'] == 1) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user'] = $_POST['email'];
                        $_SESSION['rolle'] = "Dozent";
                        header("Location: dozent.php");
                    }
                    else {
                        echo 'fehler, hier darf er nicht hinkommen';
                    }
                }
                else {
                    $_SESSION['loggedin'] = false;
                }
            }
        }
        else {
            $_SESSION['loggedin'] = false;
        }

}

 if((isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == false) or !(isset($_SESSION['loggedin']))){
    echo '<form action="?login=1" method="post">
            <fieldset id="login"> <!-- Um die Umrandung um das Login Feld bearbeiten und setzen zu können setzen wir hier eine id -->
                <legend id="legend1">Login</legend>';
     if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == false) {
         echo '<p style="color:red">Erneut versuchen</p>';
         unset($_SESSION['loggedin']);
     }
               echo 'E-Mail:<br><!-- Buttons für die Anmledung -->
                <input type="email"  style="width:90%" maxlength="250" name="email"> <!--Länge des Feldes und Anzahl erlaubter Zeichen -->

                <br><br>

                Dein Passwort:<br>
                <input type="password" style="width:90%"  maxlength="250" name="passwort"><br>

                <legend id ="legend2"></legend>
                <input type="submit" class="btn" name="submit" value="Login"> <span><?php echo $error; ?></span>
            </fieldset>

        </form>';

}
?>


