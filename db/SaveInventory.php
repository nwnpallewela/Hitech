<?php

session_start();
include '../DBCon.php';
$itemcode = $_POST['itemcode'];
$barcode = $_POST['barcode'];
$name = $_POST['name'];
$brand = $_POST['brand'];
$price = $_POST['price'];

$res = mysqli_query($con, "INSERT INTO inventory(itemcode,barcode,name,brand,price,status) VALUES
        ('" . $itemcode . "','" . $barcode . "','" . $name . "','" . $brand . "','" . $price . "','1')");
if ($res) {
    header('location:../ViewInventory.php');
} else {
    header('location:../InsertInventory.php?msg=error');
}
?>

