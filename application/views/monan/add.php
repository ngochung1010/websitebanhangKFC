
<div class="container">
    <div class="card">
    <div class="card-header">
        Thêm Món Ăn
    </div>
    <div class="card-body">
        <div class="card-header">
            <a href="<?php echo base_url('monan/list') ?>" class="btn btn-success">List Món Ăn</a>
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
        <form action="<?php echo base_url('monan/store')?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Món Ăn</label>
                <input type="text" name="tenmonan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('tenmonan').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Số Lượng</label>
                <input type="text" name="soluong" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('soluong').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Giá Bán</label>
                <input type="text" class="form-control" name="giaban" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('giaban').'</span>'?>
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Mô Tả</label>
                <input type="text" class="form-control" name="mota" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('mota').'</span>'?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình Ảnh</label>
                <input type="file" class="form-control-file" name="hinhanh" id="exampleInputPassword1">
                <small><?php if(isset($error)){echo $error;} ?></small>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Danh Mục</label>
                    <select class="form-control" name="id_danhmuc" id="exampleFormControlSelect1">
                    <!--  -->
                    <?php
                    foreach($danhmuc as $key => $danh){
                    ?>
                            <option value="<?php echo $danh->id ?>">
                                <?php echo $danh->danhmuc ?>
                            </option>
                    <?php
                    } 
                    ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tình Trạng</label>
                    <select class="form-control" name="tinhtrang" id="exampleFormControlSelect1">
                    <option value="1">Hiển Thị</option>
                    <option value="0">Khổng Hiển Thị</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">ADD</button>
        </form>
    </div>
    </div>
</div>