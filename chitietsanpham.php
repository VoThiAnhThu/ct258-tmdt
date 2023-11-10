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

<?php
    // 1. Mở kết nối
    include_once __DIR__ . '/dbconnect.php';
    //2. chuẩn bị câu lệnh
    $sp_ma = $_GET['sp_ma'];
    $sqlSanPham = "SELECT * FROM sanpham
                    WHERE sp_ma = $sp_ma;";
    

    
    //3. Thực thi
    $resultSanPham = mysqli_query($conn, $sqlSanPham);
    //4. Phân tách
    $dataSanPham = [];
    $dataSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC);
    //--------Tìm dữ liệu hình sp
    $sqlHinhSanPham = "SELECT * FROM hinhsanpham
                        WHERE sp_ma = $sp_ma;";
    //Thực thi
    $resultHinhSanPham = mysqli_query($conn, $sqlHinhSanPham);
    //Phân tách
    $dataHinhSanPham = [];
    while($row = mysqli_fetch_array($resultHinhSanPham , MYSQLI_ASSOC)){
        $dataHinhSanPham[] = array(
            'hsp_ma' => $row['hsp_ma'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
            'sp_ma' => $row['sp_ma'],
        );
    }
    //Lấy các sản phẩm liên quan
    $resultSanPham = mysqli_query($conn, $sqlSanPham);
    if ($resultSanPham) {
        $rowSanPham = mysqli_fetch_assoc($resultSanPham);
        $lsp_ma = $rowSanPham['lsp_ma'];

        $sqlLoaiSanPham = "SELECT * FROM sanpham WHERE lsp_ma = $lsp_ma AND sp_ma <> $sp_ma";
        $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
        $dataLoaiSanPham = [];
        while ($rowLoaiSanPham = mysqli_fetch_assoc($resultLoaiSanPham)) {
            $dataLoaiSanPham[] = array(
                'sp_ma' => $rowLoaiSanPham['sp_ma'],
                'sp_ten' => $rowLoaiSanPham['sp_ten'],
                'sp_gia' => $rowLoaiSanPham['sp_gia'],
                'sp_giacu' => $rowLoaiSanPham['sp_giacu'],
                'sp_mota_ngan' => $rowLoaiSanPham['sp_mota_ngan'],
                'sp_ngaycapnhat' => $rowLoaiSanPham['sp_ngaycapnhat'],
                'sp_soluong' => $rowLoaiSanPham['sp_soluong'],
                'lsp_ma' => $rowLoaiSanPham['lsp_ma'],
                'nsx_ma' => $rowLoaiSanPham['nsx_ma'],
            );
        }
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($conn);
    }



    //var_dump($dataLoaiSanPham);

    //var_dump($dataSanPham);
    //var_dump($dataHinhSanPham);
    ?>


    <!--Start Main-->
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if(empty($dataHinhSanPham)): ?>
                    <img src="/ct258-tmdt/assets/img/default-image.jpg" class="img_sp"/>
                <?php else: ?>
                    <?php foreach($dataHinhSanPham as $index => $hsp): ?>
                        <?php if($index == 0): ?>
                            <img src="/ct258-tmdt/assets/uploads/<?= $hsp['hsp_tentaptin'] ?>" class="img_sp"/>
                        <?php else: ?>
                            <img src="/ct258-tmdt/assets/uploads/<?= $hsp['hsp_tentaptin'] ?>" class="img_sp"/>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="col">
                <form name="frmSanPham" method="post" action="luugiohang.php" class="frmSanPham">
                    <input type="hidden" name="sp_ma" value="<?= $dataSanPham["sp_ma"] ?>"/>
                    <input type="hidden" name="sp_ten" value="<?= $dataSanPham["sp_ten"] ?>"/>
                    <input type="hidden" name="sp_gia" value="<?= $dataSanPham["sp_gia"] ?>"/>

                    <?php if(empty($dataHinhSanPham)): ?>
                        <input type="hidden" name="sp_hinhdaidien" value="/ct258-tmdt/assets/img/default-image.jpg"/>
                    <?php else: ?>
                        <?php foreach($dataHinhSanPham as $index => $hsp): ?>
                            <?php if($index == 0): ?>
                                <input type="hidden" name="sp_hinhdaidien" value="/ct258-tmdt/assets/uploads/<?= $hsp['hsp_tentaptin'] ?>"/>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <h1><?= $dataSanPham['sp_ten'] ?></h1>
                    <div class="sp-drs">
                        <b>Mô tả ngắn:</b><br>
                        <p><?= $dataSanPham['sp_mota_ngan'] ?></p>
                    </div>
                        <?php if($dataSanPham['sp_giacu'] != $dataSanPham['sp_gia']):  ?>
                            <del><span class="text-muted" style="font-size: 0.8rem;">
                                <?= number_format($dataSanPham['sp_giacu'], 0, ',', '.') ?></span>
                            </del>
                        <?php endif; ?>
                        <br>
                        <span class="gia-tien"><b><?= number_format($dataSanPham['sp_gia'], 0, ',', '.') ?></b></span>
                        <div>
                            <label for="">Số lượng: </label>
                            <input class="form-control sp-sl" type="number" name="sp_dh_soluong"/><br/>
                        </div>
                        
                    <button name="btnDatMua"  class="nut-datmua">Chọn mua</button>
                    <a href="sanpham.php" class="btn btn-primary">Quay về</a>
                </form>
            </div>
        </div>
        <!--Sản phẩm gợi ý-->
        <div class="container">
            <h3 style="text-align: left">Các Sản Phẩm Liên Quan</h3>
            <div class="row">
                <?php foreach($dataLoaiSanPham as $lsp): ?>
                    <div class="col-md-3">
                        <div class="sp-item card">
                            <?php if(!empty($sp['hsp_tentaptin'])): ?>
                                <img  src="/ct258-tmdt/assets/uploads/<?=$sp['hsp_tentaptin']?>" class="card-img-top" alt="...">
                            <?php else: ?>
                                <img  src="/ct258-tmdt/assets/img/default-image.jpg" class="card-img-top" alt="...">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $lsp['sp_ten'] ?></h5>
                                <p class="card-text">
                                    <?= $lsp['sp_mota_ngan'] ?>    
                                </p>
                                <p>
                                    <?php if($lsp['sp_giacu'] != $lsp['sp_gia']): ?>
                                        <del>
                                            <span class="text-muted">
                                                <?=number_format( $lsp['sp_giacu'],0,'.',',') ?>
                                            </span>
                                        </del>
                                    <?php endif; ?>
                                    <br>
                                    <b><?=number_format( $lsp['sp_gia'],0,'.',',') ?></b>
                                </p>
                                <a href="chitietsanpham.php?sp_ma=<?=$lsp['sp_ma'] ?>" class="btn btn-primary">Chi tiết sản phẩm</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
