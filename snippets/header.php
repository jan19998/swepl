<?php session_start(); ?>
<header>
    <div class="row pb-3">
        <div class="col-11">
            <a href="startseite.php">
                <img class="logo img-fluid" alt="SWEpl Logo" src="pictures/swepl.png" width="100" height="100">
            </a>
        </div>
        <div class="col-1 align-self-center justify-content-end ">
            <form action="Logout.php">
                <button class="btn" type="submit" value="logout">Logout</button>
            </form>
        </div>
    </div>
    <?php
    /*$dbname = 'swepl';
    $dbuser = 'root';
    $dbpass = '';
    $dbhost = '127.0.0.1';

    $remoteConnection = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
    mysqli_select_db($remoteConnection, $dbname) or die("Could not open the db '$dbname'");*/

    require_once __DIR__ ."/../vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::create(__DIR__, '/../.env');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
    $remoteConnection = mysqli_connect(
        getenv('DB_HOST'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_NAME'),
        (int)getenv('DB_PORT')
    );

    //require_once "snippets/dbconnect.php";
    //$db = new dbconnect();
    ?>
</header>