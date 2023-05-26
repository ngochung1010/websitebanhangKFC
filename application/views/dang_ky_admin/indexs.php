<section class="h-100 h-custom" style="background-color: #8fc4b7;">  
            <?php
				    if($this->session->flashdata('success')){
				?>
					<div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
					<?php
					}elseif($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
				<?php
				}
				?>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://thietkethuonghieu.mondial.vn/application/media/news/2023/thang_03/63713861_6.jpg"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
            <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Đăng ký Admin</h3>

                <!-- báo lỗi -->
                
                <form action="<?php echo base_url('dang-ky-thanh-vien') ?>" method="POST">

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1q">Họ & Tên</label>
                      <input type="text" name="username" id="form3Example1q" class="form-control" />
                      <?php echo '<span class="text text-danger">'.form_error('username').'</span>' ?>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1q">email</label>
                      <input type="text" name="email" id="form3Example1q" class="form-control" />
                      <?php echo '<span class="text text-danger">'.form_error('email').'</span>' ?>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1q">Mật Khẩu</label>
                      <input type="text" name="password" minlength="9" maxlength="16" id="form3Example1q" class="form-control" />
                      <?php echo '<span class="text text-danger">'.form_error('password').'</span>' ?>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg mb-1">Đăng Ký</button>
                    <a href="<?php echo base_url('login') ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i> Quay lại</a>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>




