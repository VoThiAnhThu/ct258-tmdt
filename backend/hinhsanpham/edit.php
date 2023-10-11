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

    $hsp_ma = $_GET['hsp_ma'];
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
            'sp_ma' => $row['sp_ma'],
        );
    }

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once __DIR__ . '/../layouts/sidebar.php';
                ?>
            </div>
            <div class="col-md-9">
            <h3>SỬA HÌNH SẢN PHẨM</h3>
                <form action="" name="frmThemMoi" method="POST">
                    <div class="form-group">
                        <label for="">Sản phẩm</label>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <?php foreach($dataSanPham as $sp): ?>
                                <?php if($sp['sp_ma'] == $dataDLCu['sp_ma']): ?>
                                    <option value="<?= $sp['sp_ma']?>" selected><?= $sp['sp_ten']?></option>      
                                <?php else: ?>
                                    <option value="<?= $sp['sp_ma']?>"><?= $sp['sp_ten']?></option>
                                <?php endif;?> 
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm</label>
                    </div>
                    <div class="form-group">
                        <label>Hình sản phẩm</label>
                        <div class="preview-img-container">
                            <input type="hidden" name="hsp_tentaptin"
                                value="<?=$dataDLCu['hsp_tentaptin']?>" >
                            <img src="/ct258-tmdt/assets/uploads/<?=$dataDLCu['hsp_tentaptin']?>" id="preview-img" style="width: 200px;">
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
            $hsp_tentaptin = $_POST['hsp_tentaptin'];

            //Người dùng chọn file upload
            if(!empty($_FILES['hsp_tentaptin']['name'])) {

                //B1: Di chuyen anh
                $upLoadDir = __DIR__ . '/../../assets/uploads/';

                $newFileName = date('Ymd_His') . '_' . $_FILES['hsp_tentaptin']['name'];

                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'],$upLoadDir .  $newFileName);

                //Xoa link 
                unlink($upLoadDir . $hsp_tentaptin);
                //Cap nhat anh
                $hsp_tentaptin = $newFileName;
            }
        
            $sqlUpdate = "  UPDATE hinhsanpham
                            SET
                                sp_ma=$sp_ma,
                                hsp_tentaptin='$hsp_tentaptin'
                            WHERE hsp_ma=$hsp_ma";
            //Thuc thi
            mysqli_query($conn,$sqlUpdate); 
            echo '<script>location.href = "index.php";</script>';
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