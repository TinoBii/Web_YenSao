<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar('users')?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập Nhật thông tin
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" class="form-control" name="fullname" id="display-name" value="<?php echo $info_user['fullname']?>">
                        <?php echo form_error('fullname')?>
                </div>
                <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" disabled class="form-control" name="username" id="username" placeholder="admin" value="<?php echo $info_user['username']?>" readonly="readonly">
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                        <input type="email" disabled class="form-control" name="email" id="email" value="<?php echo $info_user['email']?>">
                      
                </div>
                <div class="form-group">
                <label for="tel">Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone_number" id="tel" value="<?php echo $info_user['phone_number']?>">
                        <?php echo form_error('phone_number')?>
                </div>
                <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" class="form-control" id="content" cols="30" rows="5" ><?php echo $info_user['address']?></textarea>
                </div>
                <button type="submit" name="btn-update" class="btn btn-primary">Cập nhật thông tin</button>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>