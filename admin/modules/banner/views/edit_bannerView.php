<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa Banner
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tiêu đề</label>
                    <input type="text" class="form-control" value="<?php echo $edit_banner['banner_title']?>" name="banner_title" id="title">
                        <?php echo form_error('banner_title')?>
                </div>
                <div class="form-group">
                    <label for="content">Mô tả</label>
                    <textarea name="mota" id="desc" class="form-control" id="content" cols="30" rows="5"><?php echo $edit_banner['mota']?></textarea>
                    <?php echo form_error('mota')?>
                </div>
                <div class="form-group">
                    <label for="content">Link</label>
                    <input type="text" value="<?php echo $edit_banner['url']?>" class="form-control" name="url" id="title">
                    <?php echo form_error('url')?>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>                   
                    </div>
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/<?php echo $edit_banner['img']?>"></div>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" <?php if($edit_banner['trangthai']=='Chờ duyệt'){echo 'checked';}?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai"  <?php if($edit_banner['trangthai']=='Công khai'){echo 'checked';}?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                <?php echo form_error('trangthai')?>
                <div class="form-group">
                    <label for="">Loại Banner</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loai_banner" id="exampleRadios1" value="Banner trái" <?php if($edit_banner['loai_banner']=='Banner trái'){echo 'checked';}?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Banner trái
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loai_banner" id="exampleRadios2" value="Banner trên" <?php if($edit_banner['loai_banner']=='Banner trên'){echo 'checked';}?>>
                        <label class="form-check-label" for="exampleRadios2">
                           Banner trên
                        </label>
                    </div>
                </div>
                <?php echo form_error('loai_banner')?>
                <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>