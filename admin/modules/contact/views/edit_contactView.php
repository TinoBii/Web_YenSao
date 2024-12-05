<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Chỉnh sửa thông tin liên hệ khách hàng
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fullname">Họ Tên</label>
                                    <input type="text" name="fullname" class="form-control" value="<?php echo $edit_contact['fullname'] ?>" id="fullname">
                                    <?php echo form_error('fullname') ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $edit_contact['email'] ?>" id="email">
                                    <?php echo form_error('email') ?>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input type="text" name="phone_number" class="form-control" value="<?php echo $edit_contact['phone_number'] ?>" id="phone_number">
                                    <?php echo form_error('phone_number') ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"><?php echo $edit_contact['content'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="job">Nghề nghiệp</label>
                                    <input type="text" name="job" class="form-control" value="<?php echo $edit_contact['job'] ?>" id="job">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="mt-3"> 
                                <img id="image" width="300px" height="300px" src="public/images/<?php echo $edit_contact['img'] ?>">
                            </div>
                        </div>

                        <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
