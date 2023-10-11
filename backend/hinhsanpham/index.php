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
    //2 Cau lenh
    $mysql = "SELECT hsp.* , sp.sp_ten
                FROM sanpham sp
                JOIN hinhsanpham hsp ON sp.sp_ma = hsp.sp_ma ";
    //3. Thuc thi
    $reuslt = mysqli_query($conn,$mysql);
    //4 Boc tach du lieu 
    $data = [];
    while($row = mysqli_fetch_array($reuslt, MYSQLI_ASSOC)) {
        $data[] = array(
            'hsp_ma' => $row['hsp_ma'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
            'sp_ten' => $row['sp_ten']
        );
    };

    //var_dump($data);
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
        <?php
        include_once __DIR__ . '/../layouts/sidebar.php';
        ?>
            </div>
            <div class="col-md-9">
            <h3>DANH SÁCH HÌNH SẢN PHẨM</h3>
            <a href="create.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-plus"></i>    
                Thêm mới
            </a>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                         <th>Mã </th>
                         <th>Hình</th>
                         <th>Sản phẩm</th>
                         <th>Hành động</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $hsp):?>
                        <tr>
                            <td><?=$hsp['hsp_ma']?></td>
                            <td>
                                <img src="/ct258-tmdt/assets/uploads/<?=$hsp['hsp_tentaptin']?>" style="width: 200px;">
                            </td>
                            <td><?=$hsp['sp_ten']?></td>
                            <td>
                                <a href="edit.php?hsp_ma=<?=$hsp['hsp_ma']?>" 
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pencil"></i>
                                    Sửa</a>
                                <a href="#" class="btn btn-danger btnDelete"  data-hsp_ma = <?=$hsp['hsp_ma']?> >
                                    <i class="fa-solid fa-trash"></i>
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
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
            //$('#danhsach').DataTable();

            $('.btnDelete').click(function() {
                
                var hsp_ma = $(this).data('hsp_ma');
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
                        
                            location.href = 'delete.php?hsp_ma=' + hsp_ma;
                    }
                })
            })
        });


        

    </script>
    

</body>
</html>