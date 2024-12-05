<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa bài viết
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input type="text" name="post_title" value="<?php echo $post['post_title']?>" class="form-control" id="title">
                    <?php echo form_error('post_title')?>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="post_description" class="form-control" id="content" cols="30" rows="5"><?php echo $post['post_description']?></textarea>
                    <?php echo form_error('post_description')?>
                </div>
                <div class="form-group">
                    
                    <label for="desc">Nội dung Chi tiết</label>
                    <textarea name="post_detail" id="desc" class="textarea"><?php echo $post['post_detail']?></textarea>
                    <?php echo form_error('post_detail')?>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                         
                    </div>
                    
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/<?php echo $post['img']?>"></div>
                </div>


                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select name="danhmuc_id" class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php
                        foreach($list_post_cat as $item)
                        {
                        ?>
                        <option value="<?php echo $item['danhmuc_id']?>" <?php if($item['danhmuc_id']==$post['danhmuc_id']){echo 'selected="selected"';}?>><?php echo $item['danhmuc_id']." - ".$item['ten_danhmuc']?></option>
                    
                        <?php
                        }
                        ?>
                    </select>
                    <?php echo form_error('danhmuc_id')?>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" <?php if($post['trangthai']=='Công khai'){echo 'checked';}?> >
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai"  <?php if($post['trangthai']=='Công khai'){echo 'checked';}?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                <button type="submit" name="btn-delete" class="btn btn-danger">Xác nhận xóa</button>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>