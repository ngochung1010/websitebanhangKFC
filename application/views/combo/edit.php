
<div class="container">
    <div class="card">
    <div class="card-header">
        Sửa Danh Mục
    </div>
    <div class="card-body">
        <a href="<?php echo base_url('combo/list') ?>" class="btn btn-success">Danh Sách Danh Mục</a>
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
        <form action="<?php echo base_url('combo/update/'.$combo->id) ?>" method="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Danh Mục</label>
                <input type="text" name="danhmuc" value="<?php echo $combo->danhmuc ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('danhmuc').'</span>' ?>
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Mô Tả</label>
                <input type="text" class="form-control" name="mota" value="<?php echo $combo->mota ?>" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('mota').'</span>'?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình Ảnh</label>
                <input type="file" class="form-control-file" name="hinhanh" id="exampleInputPassword1">
                <img src="<?php echo base_url('uploads/img_danhmuc/'.$combo->hinhanh) ?>" width="150" height="150">    
                <small><?php if(isset($error)){echo $error;} ?></small>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tình Trạng</label>
                    <select class="form-control" name="tinhtrang" id="exampleFormControlSelect1">
                    <?php
                    if($combo->tinhtrang == 1)
                    {
                    ?>
                    <option selected value="1">Hiển Thị</option>
                    <option value="0">Không Hiển Thị</option>
                    <?php
                    }else{
                    ?>
                    <option value="1">Hiển Thị</option>
                    <option selected value="0">Không Hiển Thị</option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
    </div>
</div>