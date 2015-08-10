<?php

session_start();
include '../DBCon.php';
include '../ctrl/setUserPrivilege.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isAdmin()) {
        $id = $_GET['id'];
        $idname = $_GET['idname'];
        $table = $_GET['table'];
        $url = $_GET['url'];
        $status = $_GET['status'];

        $res = mysqli_query($con, "UPDATE $table SET status=$status WHERE $idname='$id'");
        if ($res) {
            header('location:../' . $url . '.php');
        } else {
            header('location:../' . $url . '.php?msg=error');
        }
    } else {
        header('location: ../Home.php?msg=error');
    }
} else {
    $id = $_POST['id'];
    $idname = $_POST['idname'];
    $table = $_POST['table'];
    $url = $_POST['url'];

    if (isAdmin()) {
        $res = mysqli_query($con, "UPDATE $table SET status='0' WHERE $idname='$id'");
    } else {
        $res = mysqli_query($con, "UPDATE $table SET status='2' WHERE $idname='$id'");
    }
    if ($res) {
        header('location:../' . $url . '.php');
    } else {
        header('location:../' . $url . '.php?msg=error');
    }
}
?>