<?php

session_start();
include '../DBCon.php';
$nic = $_POST['nic'];
$pw = md5($_POST['pw']);

$res = mysqli_query($con, "SELECT * FROM user JOIN type ON user.idtype = type.idtype WHERE nic='$nic' AND pw='$pw' AND status='1'");
if ($row = mysqli_fetch_array($res)) {
    $_SESSION['iduser'] = $row['iduser'];
    $_SESSION['type'] = $row['type'];
    $_SESSION['nic'] = $row['nic'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['gender'] = $row['gender'];
    $_SESSION['address'] = $row['address'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['mobile1'] = $row['mobile1'];
    $_SESSION['mobile2'] = $row['mobile2'];
    $_SESSION['fax1'] = $row['fax1'];
    $_SESSION['fax2'] = $row['fax2'];

    $date_time = date('Y-m-d H:i:s');
    // Function to get the client IP address
    $ip = getenv('HTTP_CLIENT_IP')? :
            getenv('HTTP_X_FORWARDED_FOR')? :
                    getenv('HTTP_X_FORWARDED')? :
                            getenv('HTTP_FORWARDED_FOR')? :
                                    getenv('HTTP_FORWARDED')? :
                                            getenv('REMOTE_ADDR');

    $res = mysqli_query($con, "INSERT INTO loghistory(iduser,intime,ip) VALUES
        ('" . $_SESSION['iduser'] . "','" . $date_time . "','" . $ip . "')");
    if ($res) {
        header('location:../Home.php');
    } else {
        header('location:../Index.php?msg=error');
    }
} else {
    header('location:../Index.php?msg=error');
}
?>
