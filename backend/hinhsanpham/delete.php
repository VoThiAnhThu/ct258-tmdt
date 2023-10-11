<?php
    //1. Mở kêts nối

    $hsp_ma = $_GET['hsp_ma'];
    include_once __DIR__ . '/../../dbconnect.php';

    
    //2 Thuc thi cau lệnh lay du lieu cu
    $sqlSelectDLCu = "select * 
                    from hinhsanpham 
                    where hsp_ma = $hsp_ma";
    //Thuc thi cau lenh
    $resultDLCu = mysqli_query($conn, $sqlSelectDLCu);
    $dataDLCu = [];
    while($row = mysqli_fetch_array($resultDLCu, MYSQLI_ASSOC)) {
        $dataDLCu = array(
            'hsp_ma' => $row['hsp_ma'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
        );
    }

    //Xóa file rác
    $uploadDir = __DIR__ . '/../../assets/uploads/';
    unlink($uploadDir . $dataDLCu['hsp_tentaptin']);

    $sqlDelete = "DELETE from hinhsanpham
                    where hsp_ma =  $hsp_ma";

    mysqli_query($conn,$sqlDelete);

    echo '<script>location.href = "index.php";</script>'
?>