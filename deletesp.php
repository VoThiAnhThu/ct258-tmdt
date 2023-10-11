<?php
    session_start();

    unset($_SESSION['giohangData']);

    //Điều hướng
    echo '<script>location.href="giohang.php"</script>'
?>