
<div class="container">
    <div class="card">
    <div class="card-header">
        Sửa Món Ăn
    </div>
    <div class="card-body">
        <a href="<?php echo base_url('monan/list') ?>" class="btn btn-success">List Món Ăn</a>
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
        <form action="<?php echo base_url('monan/update/'.$monan->id) ?>" method="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Món Ăn</label>
                <input type="text" name="tenmonan" value="<?php echo $monan->tenmonan ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('tenmonan').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Số Lượng</label>
                <input type="text" name="soluong" value="<?php echo $monan->soluong ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('soluong').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Giá Bán</label>
                <input type="text" name="giaban" value="<?php echo $monan->giaban ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php echo '<span class="text text-danger">'.form_error('giaban').'</span>' ?>
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Mô Tả</label>
                <input type="text" class="form-control" name="mota" value="<?php echo $monan->mota ?>" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('mota').'</span>'?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình Ảnh</label>
                <input type="file" class="form-control-file" name="hinhanh" id="exampleInputPassword1">
                <img src="<?php echo base_url('uploads/img_monan/'.$monan->hinhanh) ?>" width="150" height="150">    
                <small><?php if(isset($error)){echo $error;} ?></small>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Danh Mục</label>
                    <select class="form-control" name="id_danhmuc" id="exampleFormControlSelect1">
                    <!--  -->
                    <?php
                        foreach($combo as $key => $bra){
                        ?>
                            <option <?php echo $bra->id==$monan->id_danhmuc ? 'selected' : '' ?> value="<?php echo $bra->id ?>"><?php echo $bra->danhmuc ?></option>
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
                    <?php
                    if($monan->tinhtrang == 1)
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