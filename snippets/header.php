<header>
    <div class="row pb-3">
        <div class="col-11">
            <a href="startseite.php">
                <img class="logo img-fluid" alt="SWEpl Logo" src="pictures/swepl.png" width="100" height="100">
            </a>
        </div>
        <div class="col-1 align-self-center justify-content-end ">
                <button class="btn" type="submit" action="logout.php" value="logout">Logout</button>
        </div>
    </div>
    <?php
    $dbname = 'swepl';
    $dbuser = 'root';
    $dbpass = '';
    $dbhost = '127.0.0.1';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
    mysqli_select_db($connect, $dbname) or die("Could not open the db '$dbname'");
    ?>
</header>