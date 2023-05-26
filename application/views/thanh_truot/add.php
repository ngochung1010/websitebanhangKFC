
<div class="container">
    <div class="card">
    <div class="card-header">
        Thêm Slider
    </div>
    <div class="card-body">
        <div class="card-header">
            <a href="<?php echo base_url('thanh_truot/list') ?>" class="btn btn-success">Danh Sách Slider</a>
        </div>
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
    <!-- enctype="multipart/form-data" chia nhỏ hình ảnh upload lên sever -->
        <form action="<?php echo base_url('thanh_truot/store') ?>" method="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Slider</label>
                <input type="text" name="ten_slider" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('ten_slider').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình Ảnh</label>
                <input type="file" class="form-control-file" name="hinhanh_slider" id="exampleInputPassword1">
                <small><?php if(isset($error)){echo $error;} ?></small>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tình Trạng</label>
                    <select class="form-control" name="tinhtrang_slider" id="exampleFormControlSelect1">
                    <option value="1">Hiển Thị</option>
                    <option value="0">Khổng Hiển Thị</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
    </div>
</div>