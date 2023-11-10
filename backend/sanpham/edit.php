
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <?php
    include_once __DIR__ . '/../layouts/style.php';
    ?>
</head>
<body>
    <?php
    include_once __DIR__ . '/../layouts/header.php';
    ?>
    <?php
    // 1. Mở kết nối
    include_once __DIR__ . '/../../dbconnect.php';
        //Tìm dữ liệu cũ
        $sp_ma = $_GET['sp_ma'];
        //Câu lệnh tìm dl cũ
        $sqlSelectSanphamCu = "SELECT * 
                                FROM sanpham
                                WHERE sp_ma = $sp_ma;";
        //thực thi
        $resultSanphamCu = mysqli_query($conn, $sqlSelectSanphamCu);
        //Bóc tách dữ liệu
        $dataSanphamCu = [];
        while($row = mysqli_fetch_array($resultSanphamCu, MYSQLI_ASSOC)){
            $dataSanphamCu = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'sp_giacu' => $row['sp_giacu'],
                'sp_mota_ngan' => $row['sp_mota_ngan'],
                'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
                'sp_soluong' => $row['sp_soluong'],
                'lsp_ma' => $row['lsp_ma'],
                'nsx_ma' => $row['nsx_ma'],
            );
        }


    //2.Chuẩn bị câu lệnh
    $sqlLoaiSanPham = "SELECT * FROM loaisanpham;";
    //3.Thực thi
    $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
     
    //4.Bóc tách dữ liệu
    $dataLoaiSanPham = [];
    while($row = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)){
        $dataLoaiSanPham[] = array(
            'lsp_ma' => $row['lsp_ma'],
            'lsp_ten' => $row['lsp_ten']
        );
        
    }

    //var_dump($danhsachSanPham);
   
    // 1. Mở kết nối
    //include_once __DIR__ . '/../../dbconnect.php';
    //2.Chuẩn bị câu lệnh
    $sqlNhaSanXuat = "SELECT * FROM nhasanxuat;";
    //3.Thực thi
    $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
     
    //4.Bóc tách dữ liệu
    $dataNhaSanXuat = [];
    while($row = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)){
        $dataNhaSanXuat[] = array(
            'nsx_ma' => $row['nsx_ma'],
            'nsx_ten' => $row['nsx_ten']
        );
        
    }

    //var_dump($danhsachSanPham);
   
    
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
                <h3>Sữa sản phẩm</h3>
                <form class="frmThemMoi" id="frmThemMoi" method="post" action="">
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="sp_ten" id="sp_ten" class="form-control"
                                value = "<?= $dataSanphamCu['sp_ten'] ?>"/>
                        <small class="form-text text-muted">Tên sản phẩm cần có ý nghĩa</small>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text" name="sp_gia" id="sp_gia" class="form-control"
                                        value = "<?= $dataSanphamCu['sp_gia'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Giá củ sản phẩm</label>
                            <input type="text" name="sp_giacu" class="form-control" 
                                value = "<?= $dataSanphamCu['sp_giacu'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <textarea class="form-control" id="sp_mota_ngan" name="sp_mota_ngan"><?= $dataSanphamCu['sp_mota_ngan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="number" name="sp_soluong" class="form-control"
                            value = "<?= $dataSanphamCu['sp_soluong'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select name="lsp_ma" class="form-control" >
                            <?php foreach($dataLoaiSanPham as $lsp): ?>
                                <?php if($lsp['lsp_ma'] == $dataSanphamCu['lsp_ma']): ?>
                                    <option value="<?= $lsp['lsp_ma'] ?>" selected>Tên: <?= $lsp['lsp_ten'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $lsp['lsp_ma'] ?>">Tên: <?= $lsp['lsp_ten'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nhà sản xuất</label>
                        <select class="form-control" name="nsx_ma" >
                            <?php foreach($dataNhaSanXuat as $nsx): ?>
                                
                                <?php if($nsx['nsx_ma'] == $dataSanphamCu['nsx_ma']): ?>
                                    <option value="<?= $nsx['nsx_ma'] ?>" selected>Tên: <?= $nsx['nsx_ten'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $nsx['nsx_ma'] ?>">Tên: <?= $nsx['nsx_ten'] ?></option>
                                <?php endif; ?>
                                
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="index.php" class="btn btn-secondary">Quay về</a>
                        <button name="btnLuu" class="btn btn-primary">Lưu</button>
                    </div>


                    <?php
                    if(isset($_POST['btnLuu'])){
                        $sp_ten = $_POST['sp_ten'];
                        $sp_gia = $_POST['sp_gia'];
                        $sp_giacu = $_POST['sp_giacu'];
                        $sp_mota_ngan = $_POST['sp_mota_ngan'];
                        $sp_soluong = $_POST['sp_soluong'];
                        $lsp_ma = $_POST['lsp_ma'];
                        $nsx_ma = $_POST['nsx_ma'];
                        $km_ma = empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma'];

                        // Valication
                        $errors = []; //Giả sử người dùng ch vi phạm lỗi nào hết
                        // Kiểm tra ô ten sp
                        

                        if(empty($sp_ten)){
                            $errors['sp_ten'][] = [
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $sp_ten,
                                'msg' => 'Vui lòng nhập tên sản phẩm'
                            ];

                        }
                        else if(strlen($sp_ten  ) < 3){
                            $errors['sp_ten'][] = [
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $sp_ten,
                                'msg' => 'Tên sản phẩm ít nhất phải có 3 kí tự trở lên'
                            ];
                        }
                        else if(strlen($sp_ten) >100){
                            $errors['sp_ten'][] = [
                                'rule' => 'maxlength',
                                'rule_value' => 100,
                                'value' => $sp_ten,
                                'msg' => 'Tên sản phẩm không được quá 100 kí tự'
                            ];
                        }
                      

                        //Chuẩn bị câu lệnh
                
                    if(count($errors) == 0){    
                        $sqlUpdate = "
                        UPDATE sanpham
                        SET
                            sp_ten='$sp_ten',
                            sp_gia=$sp_gia,
                            sp_giacu=$sp_giacu,
                            sp_mota_ngan='$sp_mota_ngan',
                            sp_ngaycapnhat=NOW(),
                            sp_soluong=$sp_soluong,
                            lsp_ma=$lsp_ma,
                            nsx_ma=$nsx_ma,
                            km_ma=$km_ma
                        WHERE sp_ma=$sp_ma
                        ";
                        mysqli_query($conn, $sqlUpdate);

                        //var_dump($sqlInsert);die;

                        // điều hướng
                        echo'<script>location.href = "index.php";</script>';}
    
                    }
                    ?>
                </form>
            </div>
        </div>

    </div>
    <?php if(isset($_POST['btnLuu']) && isset($errors) && count($errors) > 0 ): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Có lỗi!</strong> Vui lòng kiểm tra các thông tin sau.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <!--<span aria-hidden="true">&times;</span>-->
            </button>
            <ul>
                <?php foreach($errors as $fields): ?>
                    <?php foreach($fields as $f): ?>
                        <li><?= $f['msg'] ?>. Giá trị cũ là: <?= $f['value'] ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php
    include_once __DIR__ . '/../layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/../layouts/script.php';
    ?>

    <script>
        ClassicEditor
            .create( document.querySelector( '#sp_mota_ngan' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
    ClassicEditor
        .create( document.querySelector( '#sp_mota_chitiet' ) )
        .catch( error => {
            console.error( error );
        } );
    $(document).ready(function(){
        $('#frmThemMoi').validate({
            rules: {
                sp_ten: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                sp_gia: {
                    required: true
                }
            },
            messages: {
                sp_ten: {
                    required: 'Vui lòng nhập tên sản phẩm',
                    minlength: 'Tên sản phẩm ít nhất phải có 3 kí tự trở lên',
                    maxlength: 'Tên sản phẩm không được quá 100 kí tự'

                },
                sp_gia: {
                    required: 'Vui lòng nhập giá tiền'
                }
            }
        });
    });
    </script>
</body>
</html>






