<div class="container">
    <div class="card">
        <div class="card-header">
            Danh Sách Đơn Hàng
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
        <a href="<?php echo base_url('donhang/list') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <div class="card-header">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã Đơn Hàng</th>
                <th scope="col">Tên Món Ăn</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Số Lượng</th>
                <th scope="col">Thành Tiền</th>
            
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($chitiet_donhang as $key => $ord){
                ?>
                <tr>
                <th scope="row"><?php echo $key += 1 ?></th>
                <td><?php echo $ord->madonhang?></td>
                <td><?php echo $ord->tenmonan?></td>
                <td><img src="<?php echo base_url('uploads/img_MonAn/'.$ord->hinhanh) ?>" width="150" height="150"></td>
                <td><?php echo number_format($ord->giaban, 0 , ',', '.') ?></td>
                <td><?php echo $ord->qty?></td>
                <td>
                    <?php  
                        echo number_format($ord->giaban * $ord->qty, 0 , ',', '.'); 
                    ?>
                </td>
                <td>
                <?php
                }
                ?>
                
            </tbody>
        </table>
        <tr>
            <td>
                <select class="xulydonhang">
                    <?php
                    if($ord->tinhtrang_donhang==1)
                    {
                    ?>

                    <option selected id="<?php echo $ord->madonhang ?>" value="0">----------Xử lý đơn hàng--------</option>
                    <option id="<?php echo $ord->madonhang ?>" value="2">Đơn hàng đã được xử lý -  đang giao hàng</option>
                    <option id="<?php echo $ord->madonhang ?>" value="3">Hủy đơn</option>

                    <?php
                    }elseif($ord->tinhtrang_donhang==2)
                    {
                    ?>

                    <option id="<?php echo $ord->madonhang ?>" value="0">----------Xử lý đơn hàng--------</option>
                    <option selected id="<?php echo $ord->madonhang ?>" value="2">Đơn hàng đã được xử lý -  đang giao hàng</option>
                    <option id="<?php echo $ord->madonhang ?>" value="3">Hủy đơn</option>

                    <?php
                    }
                    else
                    {
                    ?>

                    <option id="<?php echo $ord->madonhang ?>" value="0">----------Xử lý đơn hàng--------</option>
                    <option id="<?php echo $ord->madonhang ?>" value="2">Đơn hàng đã được xử lý -  đang giao hàng</option>
                    <option selected id="<?php echo $ord->madonhang ?>" value="3">Hủy đơn</option>

                    <?php
                    }
                    ?>
                    
                </select>
            </td>
        </tr>
    </div>
    </div>
</div>