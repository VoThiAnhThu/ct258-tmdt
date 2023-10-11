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
                        <b>Mô tả ngắn:</b>
                        <?= $dataSanPham['sp_mota_ngan'] ?>
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
                </form>
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