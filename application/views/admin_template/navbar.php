<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin</a> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!-- lấy tên từ trong database lên header -->
        <?php echo $this->session->userdata('LoggedIn')['username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('logout') ?> ">Đăng Xuất</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Danh Mục
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('combo/add')?>">Thêm Danh Mục</a>
          <a class="dropdown-item" href="<?php echo base_url('combo/list') ?>">Danh Sách Danh Mục</a>
        </div>
      </li>

      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Món Ăn
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('monan/add')?>">Thêm Món Ăn</a>
          <a class="dropdown-item" href="<?php echo base_url('monan/list') ?>">Danh Sách Món Ăn</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Slider
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('thanh_truot/add')?>">Thêm Slider</a>
          <a class="dropdown-item" href="<?php echo base_url('thanh_truot/list') ?>">Danh Sách Slider</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Đơn Hàng
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('donhang/list') ?>">Danh Sách Đơn Hàng</a>
        </div>
      </li>
      
    </ul>
  </div>
</nav>
</div>