<?php
    /*
    BỔ SUNG CODE
    */
    $sp_ma = $_GET['sp_ma'];
    //1. Mở kêts nối
    include_once __DIR__ . '/../../dbconnect.php';

    //2. Tạo câu lệnh
    $sql = "DELETE FROM sanpham
            WHERE sp_ma= $sp_ma";

    //3.Thực thi
    mysqli_query($conn,$sql);

    //echo '<script>location.href = "index.php";</script>'
?>