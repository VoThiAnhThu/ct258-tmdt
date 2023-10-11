<?php
    session_start();
    //Xóa dữ liệu trong session
    unset($_SESSION['dadangnhap']);
    unset($_SESSION['kh_tendangnhap']);
    unset($_SESSION['kh_ten']);
    unset($_SESSION['kh_quantri']);

    //Điều hướng
    echo '<script>location.href="/ct258-tmdt/index.php"</script>'
?>