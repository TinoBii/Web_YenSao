<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar('users')?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Đổi mật khẩu
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" class="form-control" name="pass-old" id="pass-old">
                        <?php echo form_error('fullname')?>
                </div>
                <div class="form-group">
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="pass-new" id="pass-new">
                </div>
                <div class="form-group">
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" name="confirm-pass" id="confirm-pass">
                </div>
     
                <button type="submit" name="btn-reset" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>