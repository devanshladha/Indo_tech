<?php

    $server = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $database1 = "createx";
    $conn = mysqli_connect($server, $dbuser, $dbpass, $database1);
    if (!$conn) {
        echo"connection breaked!!";
    }
?>