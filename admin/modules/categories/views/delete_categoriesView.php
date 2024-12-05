<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Xóa danh mục
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ten_danhmuc">Tên danh mục</label>
                                    <input type="text" name="ten_danhmuc" class="form-control" value="<?php echo $delete_categories['ten_danhmuc'] ?>" id="ten_danhmuc" readonly>
                                    <?php echo form_error('ten_danhmuc') ?>
                                </div>
                                <div class="form-group">
                                    <label for="kieu">Kiểu</label>
                                    <input type="text" name="kieu" class="form-control" value="<?php echo $delete_categories['kieu'] ?>" id="kieu" readonly>
                                    <?php echo form_error('kieu') ?>
                                </div>
                                <div class="form-group">
                                    <label for="cap">Cấp</label>
                                    <input type="text" name="cap" class="form-control" value="<?php echo $delete_categories['cap'] ?>" id="cap" readonly>
                                    <?php echo form_error('cap') ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="trangthai">Trạng thái</label>
                                    <input type="text" name="trangthai" class="form-control" value="<?php echo $delete_categories['trangthai'] ?>" id="trangthai" readonly>
                                    <?php echo form_error('trangthai') ?>
                                </div>
                                <div class="form-group">
                                    <label for="noibat">Nổi bật</label>
                                    <input type="text" name="noibat" class="form-control" value="<?php echo $delete_categories['noibat'] ?>" id="noibat" readonly>
                                    <?php echo form_error('noibat') ?>
                                </div>
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
