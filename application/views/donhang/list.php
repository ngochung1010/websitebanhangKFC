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
        <div class="card-header">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã Đơn Hàng</th>
                <th scope="col">Tên Khách Hàng</th>
                <th scope="col">SĐT</th>
                <th scope="col">Địa Chỉ</th>
                <th scope="col">Tình Trạng</th>
                <th scope="col">Quản Lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($donhang as $key => $ord){
                ?>
                <tr>
                <th scope="row"><?php echo $key += 1 ?></th>
                <td><?php echo $ord->madonhang?></td>
                <td><?php echo $ord->tenkh?></td>
                <td><?php echo $ord->sdt?></td>
                <td><?php echo $ord->diachi?></td>
                <td>
                    <?php  
                    if($ord->tinhtrang == 1)
                    {
                        echo '<span class="text text-primary">Đang chờ xử lý</span>';
                    }
                    elseif($ord->tinhtrang == 2)
                    {
                        echo '<span class="text text-success">Đã Xử Ký</span>';
                    }
                    else
                    {
                        echo '<span class="text text-danger">Đã hủy</span>';
                    }
                    ?>
                </td>
                <td>
                    <a onclick="return confirm('Bạn Có Muốn Xóa Hay Không???')" href="<?php echo base_url('donhang/delete/'.$ord->madonhang) ?>" class="btn btn-danger" ><i class="fas fa-trash"></i></a> 
                    <a href="<?php echo base_url('donhang/view/'.$ord->madonhang) ?>" class="btn btn-warning"><i class="fas fa-calendar-week"></i></a>
                    <!-- <a href="<?php echo base_url('donhang/in_donhang/'.$ord->madonhang) ?>" class="btn btn-success"><i class="fa-solid fa-print"></i></a> -->
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