<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập vào tài khoản của bạn</h2>
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
						<form action="<?php echo base_url('dangnhap-khachhang') ?>" method="POST">
							<input type="email"  name="email" placeholder="Email" />
							<?php echo '<span class="text text-danger">'.form_error('email').'</span>' ?>
							<input type="password" name="matkhau" placeholder="Mật khẩu" />
							<?php echo '<span class="text text-danger">'.form_error('matkhau').'</span>' ?>

							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký Người Dùng Mới!</h2>
						<form action="<?php echo base_url('dang-ky') ?>" method="POST">
							<input type="text" name="tenkh" placeholder="Họ & Tên"/>
							<?php echo '<span class="text text-danger">'.form_error('tenkh').'</span>' ?>
							<input type="email" name="email" placeholder="Email"/>
							<?php echo '<span class="text text-danger">'.form_error('email').'</span>' ?>
							<input type="password" name="matkhau" minlength="9" maxlength="20" placeholder="Mật Khẩu (số ký tự 9-20)"/>
							<?php echo '<span class="text text-danger">'.form_error('matkhau').'</span>' ?>
							<input type="text" name="diachi" placeholder="Địa Chỉ"/>
							<?php echo '<span class="text text-danger">'.form_error('diachi').'</span>' ?>
							<input type="text" name="sdt" min="10" max="11" placeholder="Số Điện Thoại"/>
							<?php echo '<span class="text text-danger">'.form_error('sdt').'</span>' ?>
							<div class="form-group">
								<label for="exampleFormControlSelect1">Giới Tính</label>
								<select class="form-control" name="gioitinh" id="exampleFormControlSelect1">
									<option value="1">Nam</option>
									<option value="0">Nữ</option>
								</select>
                			</div>
							<button type="submit" class="btn btn-default">Signup</button>
							<br>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->