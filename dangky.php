<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="/ct258-tmdt/css/home.css">
    <?php include_once __DIR__ . '/layouts/style.php'; ?>
</head>
<body>
    <!--Start Header-->
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    <!--Start Main-->
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="dangky-container col-md-8">
                <h3 class="dangky-title text-center">Đăng Ký</h3>
                <form action="" class="frmdangky" name="frmDangKy" method="POST">
                    <div class="form-group">
                        <label class="frmdangky-label"   for="">Họ và tên khách hàng: </label>
                        <input type="text" name="kh_ten" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Tên đăng nhập</label>
                        <input type="text" name="kh_tendangnhap" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Mật khẩu: </label>
                        <input type="password" name="kh_matkhau" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Địa chỉ </label>
                        <input type="text" name="kh_diachi" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Số điện thoại: </label>
                        <input type="text" name="kh_dienthoai" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Email:  </label>
                        <input type="email" name="kh_email" class="frmdangky-input form-control">
                    </div>
                    <button name="btnDangKy" class="btndangky form-control">Đăng ký tài khoản</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__  . '/dbconnect.php';

    //Lay du lieu tu form
    if(isset($_POST['btnDangKy'])) {
        $kh_ten = $_POST['kh_ten'];
        $kh_tendangnhap = $_POST['kh_tendangnhap'];
        $kh_matkhau = md5($_POST['kh_matkhau']);
        $kh_diachi = $_POST['kh_diachi'];
        $kh_dienthoai = $_POST['kh_dienthoai'];
        $kh_email = $_POST['kh_email'];

        
        $sqlInsert ="INSERT INTO khachhang
                        (kh_tendangnhap, kh_matkhau, kh_ten, kh_diachi, kh_dienthoai, kh_email)
                    VALUES ('$kh_tendangnhap', '$kh_matkhau', '$kh_ten', '$kh_diachi', '$kh_dienthoai', '$kh_email')";
            ;
        mysqli_query($conn,$sqlInsert);
    
        //Dieu huong
        echo 'Đã Đăng Ký Thành Công!!!';
        
        echo '<a href="dangnhap.php">Trở về trang đăng nhập tài khoản</a>';
    }

    

    ?>

    <!--Start Footer-->
    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>

    

    
</body>
</html>