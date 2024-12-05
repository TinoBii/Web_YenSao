<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="post_cat_title" value="<?php echo $post_cat['post_cat_title']?>" id="title">
                    
                        <label>Trạng Thái</label>
                        <select name="trangthai">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="Công Khai" <?php if($post_cat['trangthai']=='Công Khai'){echo 'selected="selected"';}?>>Công Khai</option>
                            <option value="Chờ Duyệt" <?php if($post_cat['trangthai']=='Chờ Duyệt'){echo 'selected="selected"';}?>>Chờ duyệt</option>
                            
                        </select>
                        <button type="submit" name='btn-edit' id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>