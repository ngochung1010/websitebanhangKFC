
<!-- ///////////////////// -->
<section class="vh-100">
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
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://tuyendung.kfcvietnam.com.vn/Data/Sites/1/News/50/01-red-annule.png"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="<?php echo base_url('login-user')?>" method="POST">
          <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Địa chỉ email</label>
                <?php echo '<span class="text text-danger">'.form_error('email').'</span>' ?>
            </div>

          <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Mật khẩu</label>
                <?php echo '<span class="text text-danger">'.form_error('password').'</span>' ?>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Ghi nhớ </label>
                </div>
                <a href="<?php echo base_url('dang-ky-admin') ?>">Đăng ký</a>
            </div>
          <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">Đăng nhập</button>

            <!-- <div class="my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-muted">HOẶC</p>
            </div>

            <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                role="button">
                <i class="fab fa-facebook-f me-2"></i>Đăng nhập bằng Facebook
            </a>

            <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                role="button">
                <i class="fab fa-google me-2"></i>Đăng nhập bằng Google
            </a> -->
        </form>
      </div>
    </div>
  </div>
</section>


