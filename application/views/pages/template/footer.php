<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>KFC</span>-fast food</h2>
							<p>Đầu những năm 70, KFC được bán cho Heublein, trước khi sang nhượng lại cho PepsiCo. Năm 1987, KFC trở thành chuỗi nhà hàng phương Tây đầu tiên được mở ở Trung Quốc, và ngay lập tức mở rộng thị phần tại đây. Đó chính là thị trường lớn nhất của công ty.</p>
						</div>
					</div>
					<div class="col-sm-5s">
						<div class="container">
							<div class="row">
								<div class="col-sm-2">
									<div class="single-widget">
										
									</div>
								</div>
								<div class="col-sm-2">
									<div class="single-widget">
										<h2>Liên hệ KFC</h2>
										<ul class="nav nav-pills nav-stacked">
											<li><a href="#">Theo dõi đơn hàng</a></li>
											<li><a href="#">Hệ Thống Nhà Hàng</a></li>
											<li><a href="#">Liên hệ KFC</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="single-widget">
										<h2>Chính sách</h2>
										<ul class="nav nav-pills nav-stacked">
											<li><a href="#">Chính sách hoạt động</a></li>
											<li><a href="#">Chính sách và quy định</a></li>
											<li><a href="#">Chính sách bảo mật thông tin</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="single-widget">
										<h2>Về KFC</h2>
										<ul class="nav nav-pills nav-stacked">
											<li><a href="#">Câu Chuyện Của Chúng Tôi</a></li>
											<li><a href="#">Tin Khuyến Mãi</a></li>
											<li><a href="#">Tin tức KFC</a></li>
											<li><a href="#">Tuyển dụng</a></li>
											<li><a href="#">Đặt tiệc Sinh nhật</a></li>
										</ul>
								
									</div>
								</div>
								<div class="col-sm-2">
									<div class="single-widget">
										<h2>Các loại món ăn</h2>
										<ul class="nav nav-pills nav-stacked">
											<li><a href="#">Gà rán</a></li>
											<li><a href="#">Khoai tây chiên</a></li>
											<li><a href="#">Kem tươi</a></li>
											<li><a href="#">Các loại món ăn nhanh</a></li>
										</ul>
								
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div> -->
					
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2023 KFC Vietnam.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src=" <?php echo base_url('frontend/js/jquery.js') ?> "></script>
	<script src=" <?php echo base_url('frontend/js/bootstrap.min.js') ?>"></script>
	<script src=" <?php echo base_url('frontend/js/jquery.scrollUp.min.js') ?>"></script>
	<script src=" <?php echo base_url('frontend/js/price-range.js') ?>"></script>
    <script src=" <?php echo base_url('frontend/js/jquery.prettyPhoto.js') ?>"></script>
    <script src=" <?php echo base_url('frontend/js/main.js') ?>"></script>
	<!-- đoạn script lọc giá chị  -->
	<script>
		$(document).ready(function(){
			var active = location.search; //?kytu=asc
			$('#select-filter option[value="'+active+'"]').attr('selected','selected');
		})
		
		$('.select-filter').change(function(){
			var value = $(this).find(':selected').val();

			//alert(value);
			if(value != 0)
			{
				var url = value; 
				window.location.replace(url); // thay thế cái url bằng cái value

			}
			else
			{
				alert('Hãy Lọc Sản Phẩm');
			}
		})
	</script>
	<!-- bình luận -->
	<script>
		$('.comment').click(function(){
			// alert('ok gửi');
			var name_comment =$('.name_comment').val();
			var email_comment =$('.email_comment').val();
			var comments =$('.comments').val();
			var monan_comment =$('.monan_id_comment').val();
			var star_rating =$('.star_rating').val();
			
			// alert(name_comment);
			// alert(email_comment);
			// alert(comments);
			if(name_comment == '' || email_comment == '' || comments == '')
			{
				alert('Làm ơn điền đầy đử thông tin.')
			}
			else
			{
				$.ajax({
                method:'POST',
                url:'/binhluan/gui_binhluan',
                data:{name_comment:name_comment, email_comment:email_comment, comments:comments, monan_comment:monan_comment, star_rating:star_rating},
                success:function(){
                    // alert('Bình luận thành công.');
					$('#comment_alert').html('<span class="text text-success">Bình Luận Thành Công.</span>')
					$('.name_comment').val('');
					$('.email_comment').val('');
					$('.comments').val('');
					
			
                }
            })
			}
			
		})
	</script>

	<script>
		function ratingStar(star){
			star.click(function(){
				var stars = $('.ratingW').find('li')
				stars.removeClass('on');
				var thisIndex = $(this).parents('li').index(); //0 1 2 3 4
				for(var i=0; i <= thisIndex; i++){
					stars.eq(i).addClass('on');
				}
			putScoreNow(thisIndex+1);//4
			$('.star_rating').val(i);
			});
		}

		function putScoreNow(i){
			$('.scoreNow').html(i);
			
			
		}


		$(function(){
			if($('.ratingW').length > 0){ //check đánh giá sao != 0
				ratingStar($('.ratingW li a'));
				$('.star_rating').val('3');//nếu bình luận k chọn sao thì mặc định bình luận đó là 3 sao.
			}
		});
	</script>
</body>
</html>