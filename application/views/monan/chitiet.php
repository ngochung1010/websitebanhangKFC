<div class="container">
    <div class="card">
        <div class="card-header">
            Chi Tiết Món Ăn
        </div>
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
    <div class="card-body">
        <div class="card-header">
            <a href="<?php echo base_url('monan/list') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Món Ăn</th>
                    <th scope="col">Giá</th> 
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Hình Ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($monanchitiet as $key => $cate){
                    ?>
                    <tr>
                    <th scope="row"><?php echo $key += 1 ?></th>
                    <td><?php echo $cate->tenmonan?></td>
                    <td><?php echo number_format($cate->giaban,0,',' , '.')?></td> 
                    <td><?php echo $cate->mota?></td> 
                    <td>
                        <img src="<?php echo base_url('uploads/img_MonAn/'.$cate->hinhanh) ?>" width="150" height="150">    
                    </td> 
                    <td>
                        <!-- <?php  
                        if($cate->tinhtrang == 1)
                        {
                            echo 'Hiện Thị';
                        }
                        else
                        {
                            echo 'Không Hiện Thị';
                        }
                        ?> -->
                    </td>
                    <td>
                        <!-- delete -->
                        <!-- <a onclick="return confirm('Bạn Có Muốn Xóa Hay Không???')" href="<?php echo base_url('monan/delete/'.$cate->id) ?>" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>  -->
                        <!-- update -->
                        <!-- <a href="<?php echo base_url('monan/edit/'.$cate->id) ?>" class="btn btn-warning">
                            <i class="fas fa-pen-to-square"></i>
                        </a> -->
                        <!-- detail -->
                        <!-- <a href="<?php echo base_url('monan/chitiet/') ?>" class="btn btn-success">
                            <i class="fas fa-calendar-week"></i>
                        </a> -->
                    </td>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            
    </div>
    </div>
    </div>