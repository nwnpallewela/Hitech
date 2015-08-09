<?php

session_start();
include '../DBCon.php';
$iduser = $_SESSION['iduser'];
$nic = $_POST['nic'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$email = $_POST['email'];
$mobile1 = $_POST['mobile1'];
$mobile2 = $_POST['mobile2'];
$fax1 = $_POST['fax1'];
$fax2 = $_POST['fax2'];

$res = mysqli_query($con, "UPDATE user SET nic='$nic', name='$name', dob='$dob', gender='$gender', address='$address', email='$email', mobile1='$mobile1', mobile2='$mobile2', fax1='$fax1', fax2='$fax2' WHERE iduser='$iduser'");
if ($res) {
    header('location:../Profile.php');
} else {
    header('location:../Profile.php?msg=error');
}
?>

