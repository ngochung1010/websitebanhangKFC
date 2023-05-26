
	

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="brands_products"><!--brands_products-->
							<h2>MENU</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								<?php
                                       foreach($danhmuc as $key => $bra){
                                        ?>
                                           <li><a href="<?php echo base_url('danh-muc/'.$bra->id)?>"> 
										   		<?php echo $bra -> danhmuc?>
											</a></li>
                                        <?php
                                        }
                                        ?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Từ Khóa: <?php echo $TenMonAn ?></h2>
						<!-- -------------------------- -->
						<?php
						foreach($allTimKiem_pagination as $key => $pro){
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
`								<form action="<?php echo base_url('them-gio-hang') ?>" method="POST">
									<div class="single-products">
											<div class="productinfo text-center">
												<input type="hidden" value="<?php echo $pro->id ?>" name="MonAn_id">
												<input type="hidden" value="1" name="soluong">
												<img src="<?php echo base_url('uploads/img_MonAn/'.$pro->hinhanh) ?>" alt="<?php echo $pro -> tenmonan ?>" />
									 			<h2><?php echo number_format($pro->giaban, 0, ',' , '.') ?>VND</h2> <!------Gía sản phẩm -->
												<p><?php echo $pro->tenmonan ?></p> <!--tên món ăn-->
												<a href="<?php echo base_url('san-pham/'.$pro->id) ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Chi tiết</a>
												<button type="submit" class="btn btn-default add-to-cart">
													<i class="fa fa-shopping-cart"></i>Thêm vào giỏ
												</button>
												
											</div>
									</div>
								</form>
								<div class="choose">
									<!-- <ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul> -->
								</div>
							</div>
						</div>
						<?php
						}
						?>
						
						
					</div><!--features_items-->
					<?php
						echo $links
					?>
					
				</div>
			</div>
		</div>
	</section>
	
