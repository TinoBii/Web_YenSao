<?php
get_header();
?>
  <link rel="stylesheet" href="public/css/add_img.css">
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           CHỈNH SỬA ẢNH
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">    
                <div class="form-group">
                    <label>Hình ảnh sản phẩm</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>                        
                    </div>
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/<?php echo $img_product['url_img']?>"></div>
                </div>
                <div class="form-group">
                    <label for="intro">Số thứ tự ảnh (nhập từ 1 đến <?php echo $max_stt?>)</label> 
                    <input type="number" name="stt" class="form-control" value="<?php echo $img_product['stt']?>" id="soluong">
                        <?php echo form_error('stt')?>
                </div>
                <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhật</button>
            </form> 
        </div>
    </div>
</div>
<?php
get_footer();
?>