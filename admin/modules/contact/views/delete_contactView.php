<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Xóa liên hệ
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fullname">Họ và Tên</label>
                                    <input type="text" name="fullname" class="form-control" value="<?php echo $delete_contact['fullname'] ?>" id="fullname">
                                    <?php echo form_error('fullname') ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $delete_contact['email'] ?>" id="email">
                                    <?php echo form_error('email') ?>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input type="text" name="phone_number" class="form-control" value="<?php echo $delete_contact['phone_number'] ?>" id="phone_number">
                                    <?php echo form_error('phone_number') ?>
                                </div>
                                <div class="form-group">
                                    <label for="job">Nghề nghiệp</label>
                                    <input type="text" name="job" class="form-control" value="<?php echo $delete_contact['job'] ?>" id="job">
                                    <?php echo form_error('job') ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="content">Nội dung phản hồi</label>
                                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"><?php echo $delete_contact['content'] ?></textarea>
                                    <?php echo form_error('content') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                            <div class="mt-3"> 
                                <img id="image" width="300px" height="300px" src="public/images/<?php echo $delete_contact['img'] ?>">
                            </div>
                        </div>
                        <button type="submit" name="btn-delete" class="btn btn-danger">Xác nhận xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
