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
    $sql = "SELECT sp.*, lsp.lsp_ten, nsx.nsx_ten
                FROM sanpham sp 
                    JOIN loaisanpham lsp
                    ON sp.lsp_ma = lsp.lsp_ma 
                    JOIN nhasanxuat nsx
                    ON sp.nsx_ma = nsx.nsx_ma;
            ";
    //3 Nhờ PHP thực thi câu lệnh
    $result = mysqli_query($conn,$sql);

    //4.Bóc tách dữ liệu theo ARRAY
    $danhsachSanPham = [];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $danhsachSanPham[] = array (
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'sp_mota_ngan' => $row['sp_mota_ngan'],
            'sp_soluong' => $row['sp_soluong'],
            'lsp_ten' => $row['lsp_ten'],
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
            <h3>DANH SÁCH SẢN PHẨM</h3>
            <a href="create.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-plus"></i>    
                Thêm mới
            </a>
            <table id="danhsach" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>Giá SP</th>
                        <th>Mô tả SP</th>
                        <th>Loại SP</th>
                        <th>Nhà sản xuất</th>
                        <th>Số lượng SP</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($danhsachSanPham as $sp ): ?>
                        <tr>
                            <td><?=$sp['sp_ma'] ?></td>
                            <td><?=$sp['sp_ten'] ?></td>
                            <td>
                                <?=number_format( $sp['sp_gia'],0,'.',',') ?> 
                                <small><del><?=number_format( $sp['sp_giacu'],0,'.',',') ?></del></small>
                            </td>
                            <td><?=$sp['sp_mota_ngan'] ?></td>
                            <td><?=$sp['lsp_ten'] ?></td>
                            <td><?=$sp['nsx_ten'] ?></td>
                            <td><?=$sp['sp_soluong'] ?></td>
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