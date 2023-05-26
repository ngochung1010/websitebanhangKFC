<section>
    <!-- css sao -->
    <style>
        .counterW {margin:0 0 0 60px;}
        .ratingW {position:relative; margin:10px 0 0;}
        .ratingW li {display:inline-block; margin:0px;}
        .ratingW li a {display:block; position:relative; /*margin:0 3px;  width:28px; height:27px;color:#ccc; background:url('../img/ico/icoStarOff.png') no-repeat; background-size:100%;*/}
        /*.ratingW li.on a {background:url('../img/ico/icoStarOn.png') no-repeat; background-size:100%;}*/

        .star {
        position: relative;
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .9em;
        margin-right: .9em;
        margin-bottom: 1.2em;
        border-right: .3em solid transparent;
        border-bottom: .7em  solid #ddd;
        border-left: .3em solid transparent;
        /* Controlls the size of the stars. */
        font-size: 24px;
        }
        .star:before, .star:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        position: absolute;
        top: .6em;
        left: -1em;
        border-right: 1em solid transparent;
        border-bottom: .7em  solid #ddd;
        border-left: 1em solid transparent;
        -webkit-transform: rotate(-35deg);
                transform: rotate(-35deg);
        }
        .star:after {
        -webkit-transform: rotate(35deg);
                transform: rotate(35deg);
        }


        .ratingW li.on .star {
        position: relative;
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .9em;
        margin-right: .9em;
        margin-bottom: 1.2em;
        border-right: .3em solid transparent;
        border-bottom: .7em  solid #FC0;
        border-left: .3em solid transparent;
        /* Controlls the size of the stars. */
        font-size: 24px;
        }
        .ratingW li.on .star:before, .ratingW li.on .star:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        position: absolute;
        top: .6em;
        left: -1em;
        border-right: 1em solid transparent;
        border-bottom: .7em  solid #FC0;
        border-left: 1em solid transparent;
        -webkit-transform: rotate(-35deg);
                transform: rotate(-35deg);
        }
        .ratingW li.on .star:after {
        -webkit-transform: rotate(35deg);
                transform: rotate(35deg);
        }
    </style>
		<div class="container">
			<div class="row">
                <div class="col-sm-3">
                        <div class="left-sidebar">
                            <div class="brands_products"><!--brands_products-->
                                <h2>Thực Đơn</h2>
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
                            
                            
                            <div class="shipping text-center"><!--shipping-->
                                <img src="images/home/shipping.jpg" alt="" />
                            </div><!--/shipping-->
                        
                        </div>
                    </div>
                    
                    <div class="col-sm-9 padding-right">          
                        <?php
                        foreach($ChiTiet_MonAn as $key => $pro)
                        {
                        ?>
                        <div class="product-details"><!--product-details-->
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="<?php echo base_url('uploads/img_MonAn/'.$pro->hinhanh) ?>" alt="<?php echo $pro->tenmonan ?>" />

                                </div>
                            </div>
                            <!-- Giỏ Hàng -->
                            <form action="<?php echo base_url('them-gio-hang') ?>" method="POST">
                                <div class="col-sm-7">
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
                                    <!-- kết thúc thông báo -->

                                    <div class="product-information"><!--/product-information-->
                                        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2><?php echo $pro->tenmonan ?></h2>
                                        <input type="hidden" value="<?php echo $pro->id ?>" name="MonAn_id">
                                        <img src="images/product-details/rating.png" alt="" />
                                        <span>
                                            <span> <?php echo number_format($pro->giaban, 0 , ',' , '.') ?> VND</span>
                                            <br><br><br>

                                            <label>Số lượng còn: <?php echo $pro->soluong ?></label>
    
                                            <input type="number" min="1" max="50" value="1" name="soluong" />
                                            <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm vào giỏ
                                            </button>
                                        </span>
                                        <p><b>Danh Mục:</b> <?php echo $pro->tendanhmuc ?> </p>
                                        <p><b>Mô Tả:</b> <?php echo $pro->mota ?> </p>
                                        <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                                    </div><!--/product-information-->
                                </div>
                            </form>
                        </div><!--/product-details-->
                        <?php
                        }
                        ?>
                        <div class="category-tab shop-details-tab"><!--category-tab-->
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#reviews" data-toggle="tab">Đánh Giá</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <!-- <div class="tab-pane fade" id="details" >
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery1.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery2.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery3.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery4.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="companyprofile" >
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery1.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery3.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery2.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery4.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="tag" >
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery1.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery2.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery3.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/gallery4.jpg" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <div class="tab-pane fade active in" id="reviews" >
                                    
                                    <div class="col-sm-12">
                                        <!-- hiển thị đánh giá -->
                                        <?php
                                        foreach($list_comments as $key => $comments)
                                        {
                                        ?>

                                        <ul>
                                            <li><a><i class="fa fa-user"></i><?php echo $comments->ten ?></a></li>
                                            <li><a><i class="fa fa-clock-o"></i><?php echo $comments->ngay_thang ?></a></li>
                                            <li><a><i class="fa fa-star"></i><?php echo $comments->sao ?></a></li>
                                            
                                        </ul>
                                        <p>Đánh Giá: <?php echo $comments->danh_gia ?></p>
                                        <?php 
                                        }
                                        ?>
                                        <!-- kết thúc hiển thị -->

                                        <!-- đánh giá sao -->
                                        <p><b>Viết đánh giá của bạn:</b></p>
                                        <h6>Xếp hạng: </h6>
                                        <input type="hidden" class="star_rating" value="">
                                        <p class="counterW">Sao: <span class="scoreNow">3</span> / <span>5</span></p>
                                        <ul class="ratingW">
                                        <li class="on"><a href="javascript:void(0);"><div class="star"></div></a></li>
                                        <li class="on"><a href="javascript:void(0);"><div class="star"></div></a></li>
                                        <li class="on"><a href="javascript:void(0);"><div class="star"></div></a></li>
                                        <li><a href="javascript:void(0);"><div class="star"></div></a></li>
                                        <li><a href="javascript:void(0);"><div class="star"></div></a></li>
                                        </ul>
                                        
                                        <form >
                                            <span>
                                                <input type="hidden" class="monan_id_comment" value="<?php echo $pro->id ?> "/>
                                                <input type="text" class="name_comment" required placeholder="Họ và Tên"/>
                                                <input type="email" class="email_comment" required placeholder="Email..."/>
                                            </span>
                                            <textarea name="" class="comments" required placeholder="Bình Luận..."></textarea>

                                            <button type="button" class="btn btn-default pull-right comment">
                                                Gửi đánh giá
                                            </button>
                                            <p id="comment_alert"></p>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div><!--/category-tab-->
                        <!--recommended_items-->
                        
                        <!--/recommended_items-->
                        
                    </div>
                </div>
		</div>
	</section>