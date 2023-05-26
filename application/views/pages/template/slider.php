<section id="slider"><!--slider-->
		<!-- <div class="container"> -->
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						

						<style>
							.carousel-inner .item img
							{
								height: 350px;
								width: 100%;
								
							}
						</style>
						
						<div class="carousel-inner">
							<?php
							foreach($sliders as $key => $sli)
							{
							?>
							<div class="item <?php echo $key == 0 ? 'active' : '' ?>">
								<div class="col-sm-11">
									<img src="<?php echo base_url('uploads/img_slider/').$sli->hinhanh_slider?>" class="girl img-responsive" alt="<?php echo $sli->ten_slider?>" />
								</div>
							</div>
							<?php
							}
							?>
							<!-- <ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
							</ol> -->
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		<!-- </div> -->
	</section><!--/slider-->
	