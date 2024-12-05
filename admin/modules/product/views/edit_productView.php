<?php
get_header();

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa sản phẩm
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $edit_product['title']?>" id="product-name">
                            <?php echo form_error('title')?>
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $edit_product['price']?>" id="price">
                            <?php echo form_error('price')?>
                        </div>
                        <div class="form-group">
                            <label for="discount">Phần trăm giảm giá</label>
                            <input type="text" name="discount" class="form-control" value="<?php echo $edit_product['discount']?>" id="discount">
                            <?php echo form_error('discount')?>
                        </div>
                        <div class="form-group">
                            <label for="price_discount">Giá trước giảm</label>
                            <input type="text" name="price_discount" class="form-control" value="<?php echo $edit_product['price_discount']?>" id="price_discount">
                            <?php echo form_error('price_discount')?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cap1">Cấp 1</label>
                            <select name="cap1" class="form-control" id="cap1">
                                <option value="">--Chọn Cấp 1--</option>
                                <?php
                                $cap1_options = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `cap` = 1");
                                foreach ($cap1_options as $option) {
                                    $selected = ($edit_product['cap1'] == $option['danhmuc_id']) ? 'selected' : '';
                                    echo "<option value='{$option['danhmuc_id']}' $selected>{$option['ten_danhmuc']}</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('cap1') ?>
                        </div>

                        <div class="form-group">
                            <label for="cap2">Cấp 2</label>
                            <select name="cap2" class="form-control" id="cap2">
                                <option value="">--Chọn Cấp 2--</option>
                                <?php
                                $cap2_options = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `cap` = 2");
                                foreach ($cap2_options as $option) {
                                    $selected = ($edit_product['cap2'] == $option['danhmuc_id']) ? 'selected' : '';
                                    echo "<option value='{$option['danhmuc_id']}' $selected>{$option['ten_danhmuc']}</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('cap2') ?>
                        </div>

                        <div class="form-group">
                            <label for="cap3">Cấp 3</label>
                            <select name="cap3" class="form-control" id="cap3">
                                <option value="">--Chọn Cấp 3--</option>
                                <?php
                                $cap3_options = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `cap` = 3");
                                foreach ($cap3_options as $option) {
                                    $selected = ($edit_product['cap3'] == $option['danhmuc_id']) ? 'selected' : '';
                                    echo "<option value='{$option['danhmuc_id']}' $selected>{$option['ten_danhmuc']}</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('cap3') ?>
                        </div>

                        <div class="form-group">
                            <label for="cap4">Cấp 4</label>
                            <select name="cap4" class="form-control" id="cap4">
                                <option value="">--Chọn Cấp 4--</option>
                                <?php
                                $cap4_options = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `cap` = 4");
                                foreach ($cap4_options as $option) {
                                    $selected = ($edit_product['cap4'] == $option['danhmuc_id']) ? 'selected' : '';
                                    echo "<option value='{$option['danhmuc_id']}' $selected>{$option['ten_danhmuc']}</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('cap4') ?>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#cap1').on('change', function() {
                            const id =  $(this).val()
                            
                            $.ajax({
                                url: '?mod=product&action=ajax_get_danhmuc',
                                method: 'POST',
                                data: {id, cap:2},
                                success: function(data) {
                                    $('#cap2').html(data)
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log('Error: ' + errorThrown);
                                }
                            });
                        });
                        $('#cap2').on('change', function() {
                            const id =  $(this).val()
                            
                            $.ajax({
                                url: '?mod=product&action=ajax_get_danhmuc',
                                method: 'POST',
                                data: {id, cap:3},
                                success: function(data) {
                                    $('#cap3').html(data)
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log('Error: ' + errorThrown);
                                }
                            });
                        });
                        $('#cap3').on('change', function() {
                            const id =  $(this).val()
                            
                            $.ajax({
                                url: '?mod=product&action=ajax_get_danhmuc',
                                method: 'POST',
                                data: {id, cap:4},
                                success: function(data) {
                                    $('#cap4').html(data)
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log('Error: ' + errorThrown);
                                }
                            });
                        });
                    })
                </script>
                
                <div class="form-group">
                    <label for="intro">Mô tả sản phẩm</label> 
                    <textarea name="description" id="desc" class="textarea" id="intro" cols="30" rows="5" value="<?php echo set_value('description')?>" class="ckeditor"><?php echo $edit_product['description']?></textarea>
                </div>

                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label> 
                    <textarea name="detail" id="desc" class="textarea" id="intro" cols="30" rows="5" value="<?php echo set_value('detail')?>" class="ckeditor"><?php echo $edit_product['detail']?></textarea>
                </div>

                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/<?php echo $edit_product['img']?>"></div>
                </div>

                <div class="form-group">
                    <label for="intro">Số lượng sản phẩm</label> 
                    <input type="text" name="soluong" class="form-control" value="<?php echo $edit_product['soluong']?>" id="soluong">
                        <?php echo form_error('soluong')?>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="danhmuc_id" class="form-control">
                        <?php
                            if(!empty($list_cat)){ 
                            ?>
                            <option value="<?php echo $list_cat[0]['danhmuc_id']?>"><?php echo $list_cat[0]['ten_danhmuc']?></option>
                            <?php
                            foreach($list_cat as $item)    {   
                            ?>
                            <option value="<?php echo $item['danhmuc_id']?>"> <?php echo $item['danhmuc_id']."-".$item['ten_danhmuc']?></option>
                            
                            <?php
                            }
                            ?>
                            <?php
                                }
                                else{
                                    echo "danh mục rỗng";
                                }
                            ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" <?php if($edit_product['trangthai']=='Chờ duyệt'){echo "checked";}?> >
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai" <?php if( $edit_product['trangthai']=='Công khai'){echo "checked";}?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div style="display: flex;">
                        <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="2" id="rules">
                        <label style="margin-left: 10px;"> Sản Phẩm nổi bật</label><br>
                    </div>
                </div>
                <div class="form-group">
                    <div style="display: flex;">
                        <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="1" id="rules">
                        <label style="margin-left: 10px;"> Xóa nổi bật</label><br>
                    </div>
                </div>


                <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>