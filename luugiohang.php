<?php
session_start();

$sp_ma = $_POST['sp_ma'];
$sp_ten = $_POST['sp_ten'];
$sp_gia = $_POST['sp_gia'];
$sp_hinhdaidien = $_POST['sp_hinhdaidien'];
$sp_dh_soluong = $_POST['sp_dh_soluong'];


$giohang = [];
if(isset($_SESSION['giohangData'])) {
    $giohang = $_SESSION['giohangData'];
}

$giohang[$sp_ma] = array (
    'sp_ma' => $sp_ma,
    'sp_ten' => $sp_ten,
    'sp_gia' => $sp_gia,
    'sp_hinhdaidien' => $sp_hinhdaidien,
    'sp_dh_soluong' => $sp_dh_soluong,
);

//var_dump($giohang);

$_SESSION['giohangData'] = $giohang;

echo '<script> location.href = "giohang.php";</script>';
?>
