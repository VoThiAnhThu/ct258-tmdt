<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
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
    //Kiểm tra xem có quyền truy cập
    if(!isset($_SESSION['dadangnhap'])) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/ct258-tmdt/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false) {
        echo 'Bạn chưa đăng nhập tài khoản';
        echo '<a href="/ct258-tmdt/dangnhap.php">Click vào đây để đăng nhập</a>';
        die;
    }

    if(isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này';
        echo '<a href="/ct258-tmdt/index.php">Quay về trang chủ</a>';
        die;
    }
    ?>
    <?php
    //1 Mo ket noi
    include_once __DIR__ . '/../../dbconnect.php';
    //2 Thuc hien cau lenh SQL
    $sql = "SELECT *
            FROM khachhang";
    //3 Nhờ PHP thực thi câu lệnh
    $result = mysqli_query($conn,$sql);

    //4.Bóc tách dữ liệu theo ARRAY
    $danhsachKhachHang = [];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $danhsachKhachHang[] = array (
            'kh_tendangnhap' => $row['kh_tendangnhap'],
            'kh_matkhau' => $row['kh_matkhau'],
            'kh_ten' => $row['kh_ten'],
            'kh_diachi' => $row['kh_diachi'],
            'kh_dienthoai' => $row['kh_dienthoai'],
            'kh_email' => $row['kh_email'],
            'kh_cmnd' => $row['kh_cmnd'],
        );
    }

    //Kiem tra dump
    //var_dump($danhsachKhachHang);


    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
        <?php
        include_once __DIR__ . '/../layouts/sidebar.php';
        ?>
            </div>
            <div class="col-md-9">
            <h3>DANH SÁCH KHÁCH HÀNG</h3>
            <a href="create.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-plus"></i>    
                Thêm mới
            </a>
            <table id="danhsach" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên Đăng Nhập</th>
                        <th>Mật Khẩu</th>
                        <th>Tên Khách Hàng</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <!--
                        <th>Hành động</th>
                        -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($danhsachKhachHang as $kh ): ?>
                        <tr>
                            <td><?=$kh['kh_tendangnhap'] ?></td>
                            <td><?=$kh['kh_matkhau'] ?></td>
                            <td><?=$kh['kh_ten'] ?></td>
                            <td><?=$kh['kh_diachi'] ?></td>
                            <td><?=$kh['kh_dienthoai'] ?></td>
                            <td><?=$kh['kh_email']?></td>
                            <!-- 
                            <td>
                                <a href="edit.php?sp_ma=<?=$sp['sp_ma']?>" 
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pencil"></i>
                                    Sửa</a>
                                <a href="#" class="btn btn-danger btnDelete" data-sp_ma = <?=$sp['sp_ma']?> >
                                    <i class="fa-solid fa-trash"></i>
                                    Xóa
                                </a>
                            </td>
                            -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            
            <div id="editor"></div>

            </div>
        </div>

    <?php
    include_once __DIR__ . '/../layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/../layouts/script.php';
    ?>

    <script>
        $(document).ready( function () {
            $('#danhsach').DataTable();

            $('.btnDelete').click(function() {
                
                var sp_ma = $(this).data('sp_ma');
                /*
                var luachon = confirm('');
                if (luachon == true) {
                    
                }
            */

                Swal.fire({
                    title: 'Bạn có chắc xóa hay không?',
                    text: "Bạn không thể phục hồi sản phẩm đã xóa!!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                            location.href = 'delete.php?sp_ma=' + sp_ma;
                    }
                })
            })
        });


        

    </script>
    

</body>
</html>