
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        
    </style>

    <?php
    // / lấy đường dẫn bên ngoài
    include_once __DIR__ . '/layouts/style.php';
    ?>
</head>
<body>
    <!--Start Header-->
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    
    <!--Start Main-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="dangnhap-container col-md-6">
            <h3 class="dangnhap-title text-center">Đăng Nhập</h3>
            <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap']==true): ?>
                <h2>Ban da dang nhap roi</h2>
                <a href="dangxuat.php">Click de dang xuat tai khoan</a>
            <?php else: ?>
                <form class="frmDangNhap" action="" name="frmDangNhap" method="post">
                    <div class="form-group">
                        <label class="frmDangNhap-label"  for="">Tên đăng nhập</label>
                        <input class="frmDangNhap-input form-control"  type="text" name="kh_tendangnhap" id="kh_tendangnhap" ><br>
                    </div>
                    <div class="form-group">
                        <label class="frmDangNhap-label"  for="">Mật khẩu</label>
                        <input class="frmDangNhap-input form-control"  type="password" name="kh_matkhau" id="kh_matkhau"><br>
                        
                        <button class="btnDangNhap form-control" name="btnDangNhap">Đăng nhập</button>
                        <a class="dangnhap-link text-center" href="dangky.php">Chưa có tài khoản, nhấn đăng ký tại đây</a>
                    </div>
                </form>
            <?php endif; ?>
            <?php
                if(isset($_POST['btnDangNhap'])) {
                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                    $kh_matkhau = md5($_POST['kh_matkhau']);
                
                //Mo ket noi
                include_once __DIR__ . '/dbconnect.php';
                //Cau lenh
                $sql = "SELECT *
                        FROM khachhang
                        Where kh_tendangnhap = '$kh_tendangnhap'
                         and kh_matkhau = '$kh_matkhau'";
                //Thuc hien cau lenh
                $result = mysqli_query($conn,$sql);
                $data = [];
                $data = mysqli_fetch_array($result,MYSQLI_ASSOC);

                //Tim duoc nguoi dung trong database 
                if(!empty($data)) {
                    $_SESSION['dadangnhap'] = true;
                    $_SESSION['kh_tendangnhap'] = $kh_tendangnhap;
                    $_SESSION['kh_ten'] = $data['kh_ten'];
                    $_SESSION['kh_quantri'] = $data['kh_quantri'];
                    echo '<script>location.href = "/ct258-tmdt/index.php"</script>';
                }

                else {
                    echo '<span style="color:black; font-weight:bold;">Thông tin đăng nhập không chính xác.</span> ';
                }
            }
            ?>

            </div>
        </div>
    </div>
    <!--Start Footer-->
    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>

    
    

</body>
</html>
