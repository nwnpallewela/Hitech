<?php

session_start();
include '../DBCon.php';
$iduser = $_SESSION['iduser'];
$oldpw = md5($_POST['oldpw']);
$newpw1 = md5($_POST['newpw1']);
$newpw2 = md5($_POST['newpw2']);

$res = mysqli_query($con, "SELECT * FROM user WHERE user.iduser='$iduser'");
if ($row = mysqli_fetch_array($res)) {
    $pw = $row['pw'];
} else {
    header('location:../PasswordChangeForm.php?msg=error');
}
if ($oldpw == $pw && $newpw1 == $newpw2) {
    $res = mysqli_query($con, "UPDATE user SET pw='$newpw1' WHERE user.iduser='$iduser'");
    if ($res) {
        header('location:../db/SignOut.php');
    } else {
        header('location:../PasswordChangeForm.php?msg=error');
    }
} else {
    header('location:../PasswordChangeForm.php?msg=error');
}
?>

