<?php

$host = "localhost";
$username = "root";
$password = "123";
$database = "hitech";
$port = "3306";

$con = mysqli_connect($host, $username, $password, $database, $port);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL : " . mysqli_connect_errno();
} else {
//    echo '<h5>MySQL connected :P</h5>';
}
?>