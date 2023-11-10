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
        <li class="nav">
            <?php 
            if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == true):?>
                <a class="nav-link" href="/ct258-tmdt/dangxuat.php">ĐĂNG XUẤT</a>
                <h6 class="nav-name">Xin chào <?= $_SESSION['kh_ten']?></h6>
            <?php else: ?>
                <a class="nav-link" href="/ct258-tmdt/dangnhap.php">ĐĂNG NHẬP</a>
            <?php endif; ?>
        </li>
        <!--Cần xử lý đăng ký tài khoản-->
        <li class="nav">
            <?php 
            if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == true):?>
            
            <?php else: ?>
                <a class="nav-link" href="/ct258-tmdt/dangky.php">ĐĂNG KÝ</a>
            <?php endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ct258-tmdt/giohang.php">
            <i class="fa-solid fa-cart-shopping"></i>
          </a>
        </li>
      </ul>
        <form class="frmSearch d-flex" role="search" name="frmSearch">
          <input class="frm-input form-control me-2" type="search" placeholder="Search" aria-label="Search" name="inputSearch">
          <button class="btnSearch btn btn-outline-success" name="btnSearch" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <a class="nav-link" href="/ct258-tmdt/chatbot.php">
          <i style="font-size:24px; margin-left:30px; margin-right:3px" class="fa-solid fa-message"></i>
          Hỗ trợ khách hàng
        </a>
    </div>
  </div>
  
</nav>
