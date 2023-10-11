<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hình sản phẩm</title>
    <style>
        
    </style>

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
    /*
    //Kiểm tra xem có quyền truy cập
    if(!isset($_SESSION['dadangnhap'])) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/muabancantho/backend/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/muabancantho/backend/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này';
        echo '<a href="/muabancantho/backend/dashboard.php">Quay về trang chủ</a>';
        die;
    }
    
*/
?>
    <?php
    //1 Mo ket noi
    include_once __DIR__ . '/../../dbconnect.php';
    //2.câu lệnh
    $mysql = "SELECT sp_ma, sp_ten, sp_gia  FROM sanpham";
    //3Thuc thi
    $resultSanPham = mysqli_query($conn, $mysql);
    //4.Boc tach
    $dataSanPham = [];
    while($row = mysqli_fetch_array($resultSanPham,MYSQLI_ASSOC)){
        $dataSanPham[] = array(
            'sp_ma' => $row['sp_ma'], 
            'sp_ten' => $row['sp_ten'], 
            'sp_gia' => $row['sp_gia'], 
        );
    };

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once __DIR__ . '/../layouts/sidebar.php';
                ?>
            </div>
            <div class="col-md-9">
            <h3>HÌNH SẢN PHẨM</h3>
                <form action="" name="frmThemMoi" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Sản phẩm</label>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <?php foreach($dataSanPham as $sp): ?>
                                <option value="<?= $sp['sp_ma']?>"><?= $sp['sp_ten']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm</label>
                    </div>
                    <div class="form-group">
                        <label>Hình sản phẩm</label>
                        <div class="preview-img-container">
                            <img src="/ct258-tmdt/assets/img/default-image.jpg" id="preview-img" style="width: 200px;">
                        </div>
                        <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" class="form-control">
                    </div>
                    <div class="form-group">
                        <a href="index.php" class="btn btn-secondary">Quay về</a>
                        <button name="btnLuu" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['btnLuu'])) {
            $sp_ma =$_POST['sp_ma'];

            //Người dùng chọn file upload
            if(!empty($_FILES['hsp_tentaptin']['name'])) {

                //B1: Di chuyen anh
                $upLoadDir = __DIR__ . '/../../assets/uploads/';

                $newFileName = date('Ymd_His') . '_' . $_FILES['hsp_tentaptin']['name'];

                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'],$upLoadDir .  $newFileName);

                //Buoc 2:
                $sqlInsert = "INSERT INTO hinhsanpham
                                (hsp_tentaptin, sp_ma)
                                VALUES ( '$newFileName', $sp_ma)";
                mysqli_query($conn,$sqlInsert );
            }
        }
    
    ?>

    <?php
    include_once __DIR__ . '/../layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/../layouts/script.php';
    ?>
    <script>
        $(document).ready(function() {
            //Hiển thị ảnh preview(Xem trước) khi người dùng chọn Ảnh
            const reader = new FileReader();
            const fileInput = document.getElementById("hsp_tentaptin");
            const img = document.getElementById("preview-img");
                reader.onload = e => {
                    img.src = e.target.result;
                }
            fileInput.addEventListener('change', e=> {
                const f = e.target.files[0];
                reader.readAsDataURL(f);
            })
        });
    </script>

    

</body>
</html>