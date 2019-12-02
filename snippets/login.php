<?php
$error=''; //Variable to Store error message;
if(isset($_POST['submit'])){
    if(empty($_POST['email']) || empty($_POST['passwort'])){
        $error = "Falsches Passwort";
    }
    else
    {
        //Define $user and $pass
        $user=$_POST['email'];
        $pass=$_POST['passwort'];
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $remoteConnection = mysqli_connect("127.0.0.1", "root", "", "swepl");
        //Selecting Database
        $db = mysqli_select_db($remoteConnection, "swepl");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($remoteConnection, "SELECT * FROM swepl.benutzer WHERE `E-Mail`='$user' AND Passwort='$pass'");

        $rows = mysqli_num_rows($query);
        if($rows == 1){
            header("Location: betreuer_meilenstein.php"); // Redirecting to other page
        }
        else
        {
            $error = "Passwort ungültig";
        }
        mysqli_close($remoteConnection); // Closing connection
    }
}

?>

