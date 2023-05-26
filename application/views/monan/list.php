<div class="container">
    <div class="card">
        <div class="card-header">
            Danh Sách Món Ăn
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
            <a href="<?php echo base_url('monan/add') ?>" class="btn btn-primary">Add Món Ăn</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Món Ăn</th>
                <th scope="col">ID</th>
                <th scope="col">Danh Mục</th>
                <th scope="col">Số Lượng</th>
                <!-- <th scope="col">Giá</th> -->
                <!-- <th scope="col" width="200">Mô Tả</th>
                <th scope="col">Hình Ảnh</th> -->
                <th scope="col">Tình Trạng</th>
                <th scope="col">Quản Lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($monan as $key => $cate){
                ?>
                <tr>
                <th scope="row"><?php echo $key += 1 ?></th>
                <td><?php echo $cate->tenmonan?></td>
                <td><?php echo $cate->id?></td>
                <td><?php echo $cate->tendanhmuc?></td>
                <td><?php echo $cate->soluong?></td>
                <td>
                    <?php  
                    if($cate->tinhtrang == 1)
                    {
                        echo 'Hiện Thị';
                    }
                    else
                    {
                        echo 'Không Hiện Thị';
                    }
                    ?>
                </td>
                <!-- <td><?php echo number_format($cate->giaban,0,',' , '.')?></td> -->
                <!-- <td class="d-inline-block text-truncate" style="max-width: 200px;"><?php echo $cate->mota?></td> -->
                <!-- <td>
                    <img src="<?php echo base_url('uploads/img_MonAn/'.$cate->hinhanh) ?>" width="150" height="150">    
                </td> -->
                
                <td>
                    <!-- delete -->
                    <a onclick="return confirm('Bạn Có Muốn Xóa Hay Không???')" href="<?php echo base_url('monan/delete/'.$cate->id) ?>" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                    </a> 
                    <!-- update -->
                    <a href="<?php echo base_url('monan/edit/'.$cate->id) ?>" class="btn btn-warning">
                        <i class="fas fa-pen-to-square"></i>
                    </a>
                    <!-- detail -->
                    <a href="<?php echo base_url('monan/chitiet/'.$cate->id) ?>" class="btn btn-success">
                        <i class="fas fa-calendar-week"></i>
                    </a>
                </td>
                <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
        <!-- <?php
            echo $links
        ?> -->
    </div>
    </div>
    </div>