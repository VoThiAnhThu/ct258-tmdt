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
    
    <?php
    $giohang = [];
    if(isset($_SESSION['giohangData'])) {
        $giohang = $_SESSION['giohangData'];
    }
    ?>
    <?php
    include_once __DIR__ .'/dbconnect.php';

    $mysql = "SELECT *
            FROM hinhthucthanhtoan" ;

    $result = mysqli_query($conn,$mysql);
    $dataHTTT = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $dataHTTT[] = array(
            'httt_ma' => $row['httt_ma'],
            'httt_ten' => $row['httt_ten'],
        );
    };
    
    //var_dump($dataHTTT);
    ?>

    <form action="" name="frmThanhToan" method="POST">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 style="margin:20px; font-size:35px; font-weight:bold;">Thông Tin Khách Hàng</h2>
                    <div>
                        <label for="">Họ và tên:</label>
                        <input type="text" name="kh_ten" class="form-control">
                    </div>
                    <div>
                        <label for="">Địa chỉ nhận hàng:</label>
                        <input type="text" name="kh_diachi" class="form-control">
                    </div>
                    <div>
                        <label for="">Số điện thoại: </label>
                        <input type="text" name="kh_sdt" class="form-control">
                    </div>
                    <div> Hình thức thanh toán: <br>
                        <?php foreach($dataHTTT as $tt):?>
                            <label><input type="radio" name="httt_ma" value="<?=$tt['httt_ten']?>">
                                <?=$tt['httt_ten']?> 
                            </label><br>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="col">
                    <h2 style="margin:20px; font-size:35px; font-weight:bold;">Giỏ hàng</h2>
                    <?php if(empty($giohang)): ?>
                        <h5>Giỏ hàng của bạn đang rỗng</h5>
                        Vui lòng
                        <a href="sanpham.php">Click vào đây</a> để mua sản phẩm.
                    <?php else: ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; $tongthanhtien = 0; ?>
                                <?php foreach($giohang as $sp): ?>
                                    <tr>
                                        <td><?= $stt ?></td>
                                        <td>
                                            <img src="<?= $sp['sp_hinhdaidien'] ?>" class="img-fluid" width ="200px" heigh="200px"/>
                                        </td>
                                        <td><?= $sp['sp_ten'] ?></td>
                                        <td style="text-align:right;"><?= $sp['sp_dh_soluong'] ?></td>
                                        <td style="text-align:right;"><?= number_format($sp['sp_gia'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;"> <?= number_format($sp['sp_gia'] * $sp['sp_dh_soluong'], 0, ',', '.') ?></td>
                                        <td>
                                            <a href="deletesp.php?data-sp_ma = <?=$sp['sp_ma']?>" class="btn btn-danger btnDelete" >
                                                <i class="fa-solid fa-trash"></i>
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $stt++;
                                    $tongthanhtien += ($sp['sp_gia'] * $sp['sp_dh_soluong'])
                                    ?>
                                    <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>TỔNG TIỀN:</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format($tongthanhtien, 0, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div style="    padding-left: 75px; padding-top: 20px;">
            <a href="index.php" class="btn" style="background:palevioletred; color:antiquewhite" >Quay Về</a>
            <button name="btnLuu" class="btn" style="background:palevioletred; color:antiquewhite">Xác Nhận</button>
        </div>
    </form>

   

    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>
    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>
    <?php
        if(isset($_POST['btnLuu'])) {
            $kh_ten = $_POST['kh_ten'];
            $kh_diachi = $_POST['kh_diachi'];
            $kh_sdt = $_POST['kh_sdt'];
            $httt_ma = $_POST['httt_ma'];

            $sqlInsert ="INSERT INTO hoadon
                        (hd_tenkh, hd_diachi, hd_sdt,hd_hinhthucthanhtoan)
                        VALUES ('$kh_ten', '$kh_diachi', '$kh_sdt', '$httt_ma')";

            mysqli_query($conn,$sqlInsert);
        }

    ?>
</body>
</html>
