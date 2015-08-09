<?php

session_start();
include '../DBCon.php';
$_SESSION['status'] = '0';
$date_time = date('Y-m-d H:i:s');
$iduser = $_SESSION['iduser'];

$res = mysqli_query($con, "UPDATE loghistory SET outtime='$date_time' WHERE iduser='$iduser' ORDER BY idloghistory DESC LIMIT 1");
if ($res) {
    session_destroy();
    header('location:../Index.php');
} else {
    header('location:../Home.php?msg=error');
}
?>