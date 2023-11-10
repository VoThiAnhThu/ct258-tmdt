<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        .container {
            margin: 5px 0px;
        }
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
    //--------------Loại SP----------------
    //2 Thuc hien cau lenh SQL
    $sqlLoaiSanPham = "SELECT * FROM loaisanpham";
    //3 Nhờ PHP thực thi câu lệnh
    $resultLoaiSanPham = mysqli_query($conn,$sqlLoaiSanPham);

    //4.Bóc tách dữ liệu theo ARRAY
    $dataLoaiSanPham = [];
    while($row = mysqli_fetch_array($resultLoaiSanPham,MYSQLI_ASSOC)) {
        $dataLoaiSanPham[] = array (
            'lsp_ma' => $row['lsp_ma'],
            'lsp_ten' => $row['lsp_ten'],
        );
    }

    //--------------Nhà sản xuất----------------
    //2 Thuc hien cau lenh SQL
    $sqlNhaSX = "SELECT * FROM nhasanxuat";
    //3 Nhờ PHP thực thi câu lệnh
    $resultNhaSX = mysqli_query($conn,$sqlNhaSX);

    //4.Bóc tách dữ liệu theo ARRAY
    $dataNhaSX = [];
    while($row = mysqli_fetch_array($resultNhaSX,MYSQLI_ASSOC)) {
        $dataNhaSX[] = array (
            'nsx_ma' => $row['nsx_ma'],
            'nsx_ten' => $row['nsx_ten'],
        );
    }

   
    //Kiem tra dump
    //var_dump($danhsachSanPham);


    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once __DIR__ . '/../layouts/sidebar.php';
                ?>
            </div>
            <div class="col-md-9">
                <h3>Thêm mới sản phẩm</h3>
                
                <form name="frmThemMoi" id="frmThemMoi" action="" method="post">
                    <div class="form-group">
                        <!--Ten sp-->
                        <label>Tên Sản Phẩm</label>
                        <input type="text" name="sp_ten" id="sp_ten" class="form-control">
                        <small class="form-text text-muted">Tên sản phẩm cần có ý nghĩa</small>
                    </div>
                        <!--Gia sp-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá mới</label>
                                <input type="text" name="sp_gia" id="sp_gia" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá cũ</label>
                                <input type="text" name="sp_giacu" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <textarea id="sp_mota_ngan" name="sp_mota_ngan" class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="number" name="sp_soluong" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Loại Sản Phẩm</label>
                        <select name="lsp_ma" class="form-control">
                            <?php foreach( $dataLoaiSanPham as $lsp): ?>
                            <option value="<?= $lsp['lsp_ma']?>"><?= $lsp['lsp_ten']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nhà sản xuất</label>
                        <select name="nsx_ma" class="form-control">
                            <?php foreach( $dataNhaSX as $nsx): ?>
                            <option value="<?= $nsx['nsx_ma']?>"><?= $nsx['nsx_ten']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                    <a href="index.php" class="btn btn-secondary">Quay về</a>
                    <button name="btnLuu" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/../layouts/script.php';
    ?>

    

    <?php
        if(isset($_POST['btnLuu'])) {
            $sp_ten = $_POST['sp_ten'];
            $sp_gia = $_POST['sp_gia'];
            $sp_giacu = $_POST['sp_giacu'];
            $sp_mota_ngan = $_POST['sp_mota_ngan'];
            $sp_soluong = $_POST['sp_soluong'];
            $lsp_ma = $_POST['lsp_ma'];
            $nsx_ma = $_POST['nsx_ma'];
            
        //Kiem tra du lieu nhap vao BE Validation
        $errors = []; //truong hop ng dung chua vi pham loi
        //Ô sp:
        //Rule : required
        if(empty($sp_ten)) {
            $errors['sp_ten'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_ten,
                'messages' => 'Vui lòng nhập tên sản phẩm'
            ];
        }
        //Rule: minlength
        else if (strlen($sp_ten) < 3) {
            $errors['sp_ten'][] = [
                'rule' => 'minlength',
                'rule_value' => 3,
                'value' => $sp_ten,
                'messages' => 'Ít nhất 5 ký tự'
            ];
        }

        //Rule: maxlength
        else if (strlen($sp_ten) > 100) {
            $errors['sp_ten'][] = [
                'rule' => 'maxlength',
                'rule_value' => 100,
                'value' => $sp_ten,
                'messages' => 'Không qua 100 ky tu'
            ];
        }


        //Neu nguoi dung khong gap loi
        //Cau lenh insert 
        if(count($errors) == 0) {
        $sqlInsert ="
        Insert INTO sanpham
        (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma)
        VALUES ('$sp_ten', $sp_gia, $sp_giacu, ' $sp_mota_ngan',  NOW(), $sp_soluong, $lsp_ma, $nsx_ma)"
        ;
        //Thuc thi
        mysqli_query($conn,$sqlInsert);

        //Dieu huong
        echo '<script>location.href="index.php"</script>';
        }
    }
    ?>

    <?php if(isset($_POST['btnLuu']) && isset($errors) && count($errors) > 0 ): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>LỖI!!!</strong> Vui lòng kiểm tra lại các thông tin sau:
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul>
                <?php foreach($errors as $fields): ?>
                    <?php foreach($fields as $f): ?>
                        <li><?= $f['messages'] ?>. Gía trị bạn đã nhập là: <?= $f['value']?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <script>
        ClassicEditor
            .create( document.querySelector( '#sp_mota_ngan' ) )
            .catch( error => {
                console.error( error );
            } );


        //Hàm kiểm tra dữ liệu nhập vào ở phía FE
        $(document).ready(function(){
            $('#frmThemMoi').validate({
                rules: {
                    sp_ten: {
                        required:true,
                        minlength:3,
                        maxlength:100
                    },
                    sp_gia: {
                        required: true
                    }
                    },
                messages: {
                    sp_ten: {
                        required:'Vui lòng nhập tên sản phẩm',
                        minlength:'Ít nhất có 3 ký tự',
                        maxlength:'Không quá 100 ký tự'
                    },
                    sp_gia: {
                        required: 'Vui lòng nhập giá sản phẩm'
                    }
                }
            }) 
        })
    </script>
    

    </body>
</html>
