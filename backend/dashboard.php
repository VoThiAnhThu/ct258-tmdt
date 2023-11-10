
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <?php
    include_once __DIR__ . '/layouts/style.php';
    ?>
</head>
<body>
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">DANH MỤC SẢN PhẨM</h5>
                            <p class="card-text">Quản lý các mục thêm sửa xóa sản phẩm</p>
                            <a href="/ct258-tmdt/backend/sanpham/index.php" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">DANH MỤC HÌNH SẢN PHẨM</h5>
                            <p class="card-text">Quản lý các mục thêm sửa xóa hình ảnh sản phẩm</p>
                            <a href="/ct258-tmdt/backend/hinhsanpham/index.php" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">DANH MỤC KHÁCH HÀNG</h5>
                            <p class="card-text">Quản lý thông tin khách hàng đã đăng kí tài khoản</p>
                            <a href="//ct258-tmdt/backend/khachhang/index.php"" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">DANH MỤC ĐƠN HÀNG</h5>
                            <p class="card-text">Quản lý thông tin khách hàng đã đặt mua sản phẩm</p>
                            <a href="/ct258-tmdt/backend/donhang/index.php"" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>



</body>
</html>
