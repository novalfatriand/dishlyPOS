<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "dishly";

    $conn = mysqli_connect($hostname, $username, $password, $db_name);

    if (!$conn) {
        die(mysqli_connect_error());
    } else {
        // echo "Connection Success";
    }

?>