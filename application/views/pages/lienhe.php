<div class="container">
    <div class="row">
        <div class="md-col-12 notfound">
            <!-- <img src="<?php echo base_url('uploads/hinhanh/404notfound.jpg') ?>" alt="notfound"> -->
            <h4><center>Xin liên hệ với chúng tôi qua email. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</center></h4>
            <form action="<?php echo base_url('gui-lienhe') ?>" method="POST">
                            <!--thông báo  -->
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
                <div class="form-group">
                    <label for="exampleInputEmail1">Email </label>
                    <input type="email" class="form-control" name="email" required  id="exampleInputEmail1" aria-describedby="emailHelp">                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Họ và Tên *</label>
                    <input type="text" class="form-control" name="ten" required id="exampleInputPassword1">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Số Điện Thoại *</label>
                    <input type="text" class="form-control" name="sdt" required id="exampleInputPassword1">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Ghi Chú</label>
                    <textarea name="ghichu" id="" required resize="none" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>