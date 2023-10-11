<?php  
  session_start();
?>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/ct258-tmdt/index.php">KUMA'S BOOK</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/ct258-tmdt/sanpham.php">SẢN PHẨM</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ct258-tmdt/gioithieu.php">VỀ CHÚNG TÔI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ct258-tmdt/lienhe.php">LIÊN HỆ</a>
        </li>
        <li class="nav-item">
            <?php 
            if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == true):?>
            <h6 class="text-white">Xin chào <?= $_SESSION['kh_ten']?></h6>
                <a class="nav-link" href="/ct258-tmdt/backend/dangxuat.php">ĐĂNG XUẤT</a>
            <?php else: ?>
                <a class="nav-link" href="/ct258-tmdt/backend/dangnhap.php">ĐĂNG NHẬP</a>
            <?php endif; ?>
        </li>
        <!--Cần xử lý đăng ký tài khoản-->
        <li class="nav-item">
            <?php 
            if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == true):?>
            
            <?php else: ?>
                <a class="nav-link" href="/ct258-tmdt/backend/dangky.php">ĐĂNG KÝ</a>
            <?php endif; ?>
        </li>
      </ul>
        <form class="frmSearch d-flex" role="search" name="frmSearch">
          <input class="frm-input form-control me-2" type="search" placeholder="Search" aria-label="Search" name="inputSearch">
          <button class="btnSearch btn btn-outline-success" name="btnSearch" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
    </div>
  </div>
</nav> 
