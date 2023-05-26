<div class="container">
    <div class="card">
        <div class="card-header">
            Danh Sách Slider
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
            <a href="<?php echo base_url('thanh_truot/add') ?>" class="btn btn-primary">Thêm Slider</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Slider</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Tình Trạng</th>
                <th scope="col">Quản Lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($slider as $key => $sli){
                ?>
                <tr>
                <th scope="row"><?php echo $key += 1 ?></th>
                <td><?php echo $sli->ten_slider?></td>
                <td>
                    <img src="<?php echo base_url('uploads/img_slider/'.$sli->hinhanh_slider) ?>" width="150" height="150">    
                </td>
                <td>
                    <?php  
                    if($sli->tinhtrang_slider == 1)
                    {
                        echo 'Hiển Thị';
                    }
                    else
                    {
                        echo 'Không Hiển Thị';
                    }
                    ?>
                </td>
                <td>
                    <a onclick="return confirm('Bạn Có Muốn Xóa Hay Không???')" href="<?php echo base_url('thanh_truot/delete/'.$sli->id) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a> 
                    <a href="<?php echo base_url('thanh_truot/edit/'.$sli->id) ?>" class="btn btn-warning"><i class="fas fa-pen-to-square"></i></a>
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