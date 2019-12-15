<?php


require __DIR__. '/vendor/autoload.php';
Use eftec\bladeone\BladeOne;

$remoteConnection = mysqli_connect(
    "127.0.0.1", "root", "", "swepl"
);

$kennung = array();
$query = 'SELECT Kennung FROM Semester ORDER BY Kennung DESC';
if ($result = mysqli_query($remoteConnection, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($kennung, $row);
    }
}
$blade=new BladeOne();
echo $blade->run("jahresauswahl" ,array("kennung" => $kennung ));
