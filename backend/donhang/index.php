<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <?php
    // /../ lấy đường dẫn bên ngoài
    include_once __DIR__ . '/../layouts/style.php';
    ?>
</head>
<body>
    <?php
    include_once __DIR__ . '/../layouts/header.php';
    ?>
    
    <?php
    //Kiểm tra xem có quyền truy cập
    if(!isset($_SESSION['dadangnhap'])) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/ct258-tmdt/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/ct258-tmdt/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này';
        echo '<a href="/ct258-tmdt/index.php">Quay về trang chủ</a>';
        die;
    }
    ?>
  
    <?php
    //1 Mo ket noi
    include_once __DIR__ . '/../../dbconnect.php';
    //2 Thuc hien cau lenh SQL
    $sql = "SELECT * FROM hoadon";
    //3 Nhờ PHP thực thi câu lệnh
    $result = mysqli_query($conn,$sql);

    //4.Bóc tách dữ liệu theo ARRAY
    $danhsachHoaDon = [];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $danhsachHoaDon[] = array (
            'hd_ma' => $row['hd_ma'],
            'hd_tenkh' => $row['hd_tenkh'],
            'hd_sdt' => $row['hd_sdt'],
            'hd_diachi' => $row['hd_diachi'],
            'hd_hinhthucthanhtoan' => $row['hd_hinhthucthanhtoan'],

        );
    }

    //Kiem tra dump
    //var_dump($danhsachHoaDon);


    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
        <?php
        include_once __DIR__ . '/../layouts/sidebar.php';
        ?>
            </div>
            <div class="col-md-9">
            <h3>DANH SÁCH ĐƠN HÀNG</h3>
            <table id="danhsach" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Tên Khách Hàng</th>
                        <th>Địa Chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Hình Thức Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($danhsachHoaDon as $hd ): ?>
                        <tr>
                            <td><?=$hd['hd_ma'] ?></td>
                            <td><?=$hd['hd_tenkh'] ?></td>
                            <td><?=$hd['hd_sdt'] ?></td>
                            <td><?=$hd['hd_diachi'] ?></td>
                            <td><?=$hd['hd_hinhthucthanhtoan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            
            <div id="editor"></div>

            </div>
        </div>

    <?php
    include_once __DIR__ . '/../layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/../layouts/script.php';
    ?>

    

</body>
</html>