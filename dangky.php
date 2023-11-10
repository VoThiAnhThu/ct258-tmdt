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
                <form action="" class="frmdangky" id="frmdangky" name="frmDangKy" method="POST">
                    <div class="form-group">
                        <label class="frmdangky-label"   for="">Họ và tên khách hàng: </label>
                        <input type="text" name="kh_ten" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Tên đăng nhập</label>
                        <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="frmdangky-input form-control">
                    </div>
                    <div class="form-group">
                        <label class="frmdangky-label"  for="">Mật khẩu: </label>
                        <input type="password" name="kh_matkhau" id="kh_matkhau" class="frmdangky-input form-control">
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

        $errors = []; //truong hop ng dung chua vi pham loi
        //Ô sp:
        //Rule : required
        if(empty($kh_tendangnhap)) {
            $errors['kh_tendangnhap'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $kh_tendangnhap,
                'messages' => 'Vui lòng nhập tên tài khoản'
            ];
        }
        //Rule: minlength
        else if (strlen($kh_tendangnhap) < 5) {
            $errors['kh_tendangnhap'][] = [
                'rule' => 'minlength',
                'rule_value' => 5,
                'value' => $kh_tendangnhap,
                'messages' => 'Ít nhất 5 ký tự'
            ];
        }

        //Rule: maxlength
        else if (strlen($kh_tendangnhap) > 100) {
            $errors['kh_tendangnhap'][] = [
                'rule' => 'maxlength',
                'rule_value' => 100,
                'value' => $kh_tendangnhap,
                'messages' => 'Không qua 100 ky tu'
            ];
        }

        if(empty($kh_matkhau)) {
            $errors['kh_matkhau'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $kh_matkhau,
                'messages' => 'Vui lòng nhập mật khẩu'
            ];
        }
        //Rule: minlength
        else if (strlen($kh_matkhau) < 8) {
            $errors['kh_matkhau'][] = [
                'rule' => 'minlength',
                'rule_value' => 5,
                'value' => $kh_matkhau,
                'messages' => 'Ít nhất 8 ký tự'
            ];
        }

        //Neu nguoi dung khong gap loi
        //Cau lenh insert 
        if(count($errors) == 0) {
        
        $sqlInsert ="INSERT INTO khachhang
                        (kh_tendangnhap, kh_matkhau, kh_ten, kh_diachi, kh_dienthoai, kh_email)
                    VALUES ('$kh_tendangnhap', '$kh_matkhau', '$kh_ten', '$kh_diachi', '$kh_dienthoai', '$kh_email')";
            ;
        mysqli_query($conn,$sqlInsert);
        echo 'Đã Đăng Ký Thành Công!!!';
        
        echo '<h3 style="text-align:center;color:palevioletred;"><a href="dangnhap.php">Trở về trang đăng nhập tài khoản</a></h3>';
        }
       
    }

    

    ?>

    <!--Start Footer-->
    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>

<script>
        ClassicEditor
            .create( document.querySelector( '#sp_mota_ngan' ) )
            .catch( error => {
                console.error( error );
            } );


        //Hàm kiểm tra dữ liệu nhập vào ở phía FE
        $(document).ready(function(){
            $('#frmdangky').validate({
                rules: {
                    kh_tendangnhap: {
                        required:true,
                        minlength:5,
                        maxlength:100
                    },
                    kh_matkhau: {
                        required: true,
                        minlength:8
                    }
                    },
                messages: {
                    kh_tendangnhap: {
                        required:'Vui lòng nhập tên tài khoản',
                        minlength:'Ít nhất có 5 ký tự',
                        maxlength:'Không quá 100 ký tự'
                    },
                    kh_matkhau: {
                        required: 'Vui lòng nhập mật khẩu',
                        minlength:'Ít nhất có 8 ký tự'
                    }
                }
            }) 
        })
    </script>
    

    
</body>
</html>
