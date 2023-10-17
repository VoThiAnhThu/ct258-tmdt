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
    <div class="main">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="/ct258-tmdt/img/carousel1.jpg" class="carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                <img src="/ct258-tmdt/img/carousel2.jpg" class="carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                <img src="/ct258-tmdt/img/carousel3.jpg" class="carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                <img src="/ct258-tmdt/img/carousel4.jpg" class="carousel-img" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <section class="content">
            <h3 class="content-title">ẤN PHẨM MỚI NHẤT</h3>
            <div class="row">
                <div class="col">
                    <div class="index-card card">
                        <img src="/ct258-tmdt/img/sanpham/20231003_163642_DeMen_phu2.jpg" class="index-card-img card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Dế Mèn Phiêu Lưu Kí</h5>
                            <p class="card-text">Tác phẩm tiêu biểu của nhà văn Tô Hoài</p>
                            <p><del>120000</del></p>
                            <p>95000</p>
                            <a href="chitietsanpham.php?sp_ma=3" class="btn btn-primary">Chi tiết sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="index-card card">
                        <img src="/ct258-tmdt/img/sanpham/20231003_163606_Elle_Jennie.jpg" class="index-card-img card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Tạp chí ELLE tháng 9</h5>
                            <p class="card-text">Ấn bản mới nhất của tòa báo nước Pháp</p>
                            <p><del>185000</del></p>
                            <p>161000</p>
                            <a href="chitietsanpham.php?sp_ma=10" class="btn btn-primary">Chi tiết sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="index-card card">
                        <img src="/ct258-tmdt/img/sanpham/20231003_171341_Anh_em_nhà_Karamazov.jpg" class="index-card-img card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Anh em nhà Karamazov</h5>
                            <p class="card-text">Đời người ít nhất đọc 1 lần trong đời</p>
                            <p><del>145000</del></p>
                            <p>80000</p>
                            <a href="chitietsanpham.php?sp_ma=5" class="btn btn-primary">Chi tiết sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="index-card card">
                        <img src="/ct258-tmdt/img/sanpham/20231003_171357_ho-so-bi-an.jpg" class="index-card-img card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Hồ Sơ Bí Ẩn</h5>
                            <p class="card-text">Khám phá chân tướng các vụ án trong quá khứ</p>
                            <p><del>196000</del></p>
                            <p>178000</p>
                            <a href="chitietsanpham.php?sp_ma=7" class="btn btn-primary">Chi tiết sản phẩm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
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
