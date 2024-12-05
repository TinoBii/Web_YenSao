<?php
get_header();
?>
 <div id="page-body" class="d-flex">
    <?php get_sidebar()?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm thành viên
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                      
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input class="form-control" type="text" name="fullname" value="" id="fullname">
                            <?php echo form_error('fullname')?>
                        </div>
                        <div class="form-group">
                            <label for="name">User name</label>
                            <input class="form-control" type="text" name="username" value="" id="username">
                            <?php echo form_error('username')?>
                        </div>
                        <div class="form-group">
                            <label for="name">Số điện thoại</label>
                            <input class="form-control" type="number" name="sdt" value="" id="sdt">
                            <?php echo form_error('sdt')?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email">
                            <?php echo form_error('email')?>
                        </div>
                        <div class="form-group">
                            <label for="passowrd">Mật khẩu</label>
                            <input class="form-control" type="password" name="password" id="password">
                            <?php echo form_error('password')?>
                        </div>
                      
                        <button type="submit" name="btn-add" value="thêm mới" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
</div>

<?php
get_footer();
?>