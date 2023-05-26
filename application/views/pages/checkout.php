<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh Toán</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
				if($this->cart->contents())
				{
				?>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								
								<td class="description">Hình ảnh</td>
								<td class="image">Tên món ăn</td>
								<td class="price">Đơn giá</td>
								<td class="quantity">Số lượng</td>
								<td class="total">Thành Tiền</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php
							$thanhtien = 0;
							$tongtien = 0;
							foreach($this->cart->contents() as $item){
								//
								$thanhtien = $item['qty']*$item['price'];
								$tongtien += $thanhtien;
							?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?php echo base_url('uploads/img_MonAn/'.$item['options']['hinhanh']) ?>" width="150" height="150" alt="<?php echo $item['name'] ?>"></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $item['name'] ?></a></h4>
								</td>
								<td class="cart_price">
									<p><?php echo number_format($item['price'], 0, ',' , '.')?>VND</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<form action="<?php echo base_url('cap-nhat-gio-hang') ?>" method="POST">
											<!-- <a class="cart_quantity_up" href=""> + </a> -->
											<input type="hidden" value="<?php echo $item['rowid'] ?>" name="rowid">
											<input class="cart_quantity_input" type="number" min="1"  max="50" name="soluong" value="<?php echo $item['qty'] ?>" autocomplete="off" >
											<br><br>
											<input type="submit" name="capnhat" class="btn btn-warning" value="Cập nhật"></input>
											<!-- <a class="cart_quantity_down" href=""> - </a> -->
									
										</form>
										
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?php echo number_format($thanhtien, 0, ',' , '.')?>VND</p>
								</td>
								
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="5" > 
									<p class="cart_total_price" > Tổng thanh toán: <?php echo number_format($tongtien, 0, ',' , '.')?>VND </p>
								</td>
								<td>
									<!-- <a href="<?php echo base_url('checkout') ?>" class="btn btn-success"> Thanh toán </a>								 -->
								</td>
							</tr>
						</tbody>
					</table>
				<?php
				}
				else
				{
					echo '<span class="text text-danger">
						<h2>Bạn cần thêm sản phẩm vào giỏ hàng!</h2>
					</span>';
				}
				?>
				</div>
			</div>
			<section><!--form-->
				<div class="container">
					<div class="row">
						
							<div class="col-sm-10 col-sm-offset-1">
								<div class="login-form"><!--login form--> 
									<h2>Điền thông tin thanh toán</h2>
									<!-- hiển thị thông tin -->
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
									<!--  -->
									<form onsubmit="return confirm('Xác nhận đặt hàng')" method="POST" action="<?php echo base_url('online-checkout') ?>">
										
										<input type="text" name="tenkh" placeholder="Họ & Tên*" />
										<?php echo '<span class="text text-danger">'.form_error('tenkh').'</span>' ?>
										<input type="text" name="diachi" placeholder="Địa Chỉ*" />
										<?php echo '<span class="text text-danger">'.form_error('diachi').'</span>' ?>
										<input type="text" name="sdt" minlength="9" maxlength="11" placeholder="Số Điện Thoại*" />
										<?php echo '<span class="text text-danger">'.form_error('sdt').'</span>' ?>
										<input type="text" name="email" placeholder="Email*" />
										<?php echo '<span class="text text-danger">'.form_error('email').'</span>' ?>
										<label>PHƯƠNG THỨC THANH TOÁN</label>
										
										<!-- <select name="hinhthuc">
											<option value="Nhận hàng thanh toán">Thánh toán khi nhận hàng</option>
											<option value="Thanh toán VNPAY">Thanh toán qua VNPAY</option>
										</select> -->
										<button type="submit" name="cod" class="btn btn-default">Thánh Toán Khi Nhận Hàng</button>
										<button type="submit" name="payUrl" class="btn btn-danger">Thánh Toán Bằng MOMO</button>
										<button type="submit" name="redirect" class="btn btn-primary">Thánh Toán Bằng VNPAY</button>
										<!-- <button type="submit" class="btn btn-default">Xác nhận thanh toán</button> -->
									</form>
								</div><!--/login form-->
							</div>
						
					</div>
				</div>
			</section><!--/form-->
		</div>
	</section> <!--/#cart_items-->