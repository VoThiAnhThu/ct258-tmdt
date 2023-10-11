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
    
    //1 Mo ket noi
    include_once __DIR__ . '/dbconnect.php';

    //Lấy Loại Sản Phẩm
    //2 Cau lenh
    $mysqlLoaiSP = "SELECT *
              FROM loaisanpham ";
    //3. Thuc thi
    $reusltLoaiSP = mysqli_query($conn,$mysqlLoaiSP);
    //4 Boc tach du lieu 
    $dataLoaiSP = [];
    while($row = mysqli_fetch_array($reusltLoaiSP, MYSQLI_ASSOC)) {
        $dataLoaiSP[] = array(
            'lsp_ma' => $row['lsp_ma'],
            'lsp_ten' => $row['lsp_ten'],
            'lsp_mota' => $row['lsp_mota'],
        );
    };

    //LẤY SẢN PHẨM
    $mysqlSanPham = "SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, 
                        MAX(hsp.hsp_tentaptin) AS hsp_tentaptin
                    FROM sanpham sp
                    LEFT JOIN hinhsanpham hsp ON hsp.sp_ma = sp.sp_ma
                    GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan";
    //3. Thuc thi
    $reusltSanPham = mysqli_query($conn,$mysqlSanPham);
    //4 Boc tach du lieu 
    $data = [];
    while($row = mysqli_fetch_array($reusltSanPham, MYSQLI_ASSOC)) {
        $dataSanPham[] = array(
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'sp_mota_ngan' => $row['sp_mota_ngan'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
        );
    };

    ?>


    <!--Start Main-->
    <div class="container">
        <div class="sp-container row">
            <div class="lsp-content col-md-3">
                <h4 class="sp-title">DANH MỤC SẢN PHẨM</h4>
                <?php foreach($dataLoaiSP as $lsp):?>
                    <ul class="lsp-list" type="none">
                        <li><a class="lsp-item" href="loaisanpham.php?lsp_ma=<?=$lsp['lsp_ma']?>"><?=$lsp['lsp_ten']?></li></a>
                    </ul>
                <?php endforeach; ?>
            </div>
            <div class="col-md-9">
                <h4 class="sp-title">SẢN PHẨM</h4>
                <div class="row">
                    <?php foreach($dataSanPham as $sp): ?>
                    <div class="col-md-3">
                        <div class="sp-item card">
                            <?php if(!empty($sp['hsp_tentaptin'])): ?>
                                <img  src="/ct258-tmdt/assets/uploads/<?=$sp['hsp_tentaptin']?>" class="card-img-top" alt="...">
                            <?php else: ?>
                                <img  src="/ct258-tmdt/assets/img/default-image.jpg" class="card-img-top" alt="...">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $sp['sp_ten'] ?></h5>
                                <p class="card-text">
                                    <?= $sp['sp_mota_ngan'] ?>    
                                </p>
                                <p>
                                    <?php if($sp['sp_giacu'] != $sp['sp_gia']): ?>
                                        <del>
                                            <span class="text-muted">
                                                <?=number_format( $sp['sp_giacu'],0,'.',',') ?>
                                            </span>
                                        </del>
                                    <?php endif; ?>
                                    <br>
                                    <b><?=number_format( $sp['sp_gia'],0,'.',',') ?></b>
                                </p>
                                <a href="chitietsanpham.php?sp_ma=<?=$sp['sp_ma'] ?>" class="btn btn-primary">Chi tiết sản phẩm</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
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