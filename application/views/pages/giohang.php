<section id="cart_items">
		<div class="container">
		<!-- thông báo  -->
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
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Giỏ Hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<!-- ------- -->
			<?php
            if($this->cart->contents())
            {
            ?>
				<table class="table table-condensed"  >
					<thead>
						<tr class="cart_menu" align="center">
							
							<td class="description">Hình ảnh</td>
                            <td class="image">Tên món ăn</td>
							<td class="price">Đơn giá</td>
							<td class="quantity">Số lượng</td>
							<td class="quantity">Số lượng hàng còn</td>
							<td class="total">Thành Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        <?php
                        $thanhtien = 0;
                        $tongtien = 0;
						$hangton = 0;
                        foreach($this->cart->contents() as $item){
                            //
							$hangton = $item['options']['soluongcondu'] - $item['qty'];
                            $thanhtien = $item['qty']*$item['price'];
                            $tongtien += $thanhtien;
                        ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo base_url('uploads/img_MonAn/'.$item['options']['hinhanh']) ?>" width="150" height="150" alt="<?php echo $item['name'] ?>"></a>
							</td>
							
							<td class="cart_description" align="center">
								<h4><a href=""><?php echo $item['name'] ?></a></h4>
							</td>
							<td class="cart_price" align="center">
								<p><?php echo number_format($item['price'], 0, ',' , '.')?>VND</p>
							</td>
							<td class="cart_quantity" align="center">
								<div class="cart_quantity_button">
									<form action="<?php echo base_url('cap-nhat-gio-hang') ?>" method="POST">
										<!-- <a class="cart_quantity_up" href=""> + </a> -->
										<input type="hidden" value="<?php echo $item['rowid'] ?>" name="rowid">
										<?php
										// if($item['qty'] > $hangton)
										if($item['qty'] > $item['options']['soluongcondu'])
										{
										?>
											<input class="cart_quantity_input" type="number" min="1"  max="50" name="soluong" value="<?php echo $item['options']['soluongcondu'] ?>" autocomplete="off" >
											
										<?php
										}else{
										?>
											<input class="cart_quantity_input" style="float: none;" type="number" min="1"  max="50" name="soluong" value="<?php echo $item['qty'] ?>" autocomplete="off" >

										<?php
										}
										?>
										<br><br>
										<Style>
											
										</Style>
										<input type="submit" name="capnhat" class="btn btn-warning" value="Cập nhật"></input>
										<!-- <a class="cart_quantity_down" href=""> - </a> -->
								
									</form>
								</div>
							</td>

							<td class="cart_description" align="center">
								<h4><?php echo $hangton?></h4>
								<!-- $item['options']['soluongcondu']  -->
							</td>

							<td class="cart_total" align="center">
								<p class="cart_total_price"><?php echo number_format($thanhtien, 0, ',' , '.')?>VND</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="<?php echo base_url('xoa-don-hang/'.$item['rowid']) ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        <?php
                        }
                        ?>
                       
					</tbody>
					<tr colspan="4">
                            <td colspan="5"> 
                                <p class="cart_total_price" > Tổng thanh toán: <?php echo number_format($tongtien, 0, ',' , '.')?>VND </p>
                            </td>
							<td  >
								<a href="<?php echo base_url('checkout') ?>" class="btn btn-success"> Thanh toán </a>
								<a href="<?php echo base_url('xoa-tat-ca') ?>" class="btn btn-danger"> Xóa tất cả </a>
								
							</td>

						
                        </tr>
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
	</section> <!--/#cart_items-->