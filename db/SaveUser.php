<?php

session_start();
include '../DBCon.php';
$type = $_POST['type'];
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
$pw = $_POST['pw'];

$res = mysqli_query($con, "INSERT INTO user(idtype,nic,name,dob,gender,address,email,mobile1,mobile2,fax1,fax2,pw,status) VALUES
        ('" . $type . "','" . $nic . "','" . $name . "','" . $dob . "','" . $gender . "','" . $address . "','" . $email . "'"
        . ",'" . $mobile1 . "','" . $mobile2 . "','" . $fax1 . "','" . $fax2 . "','" . md5($pw) . "','1')");
if ($res) {
    header('location:../Index.php');
} else {
    header('location:../SignUp.php?msg=error');
}
?>

