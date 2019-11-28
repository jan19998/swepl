<?php
    $semester = 'ws19/20';
    $gruppe = 'e9';
    $positiv = 0;
    $neutral = 0;
    $negativ = 0;

    $remoteConnection = mysqli_connect(
        "127.0.0.1", "root","","swepl"
    );

    $query1 = 'SELECT ';
