<?php
get_header();

?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Xóa sản phẩm
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $delete_product['title']?>" id="product-name">
                            <?php echo form_error('title')?>
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $delete_product['price']?>" id="price">
                            <?php echo form_error('price')?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="description" class="form-control" id="intro" cols="30" rows="5" value="<?php echo set_value('description')?>" id="desc"><?php echo $delete_product['description']?></textarea>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label> 
                    <textarea name="detail" id="desc" class="textarea" id="intro" cols="30" rows="5" value="<?php echo set_value('detail')?>" class="ckeditor"><?php echo $delete_product['detail']?></textarea>
                </div>

                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/<?php echo $delete_product['img']?>"></div>
                </div>

                <div class="form-group">
                    <label for="intro">Số lượng sản phẩm</label> 
                    <input type="text" name="soluong" class="form-control" value="<?php echo $delete_product['soluong']?>" id="soluong">
                        <?php echo form_error('soluong')?>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="cat_id" class="form-control">
                        <?php
                            if(!empty($list_cat)){ 
                            ?>
                            <option value="<?php echo $list_cat[0]['cat_id']?>"><?php echo $list_cat[0]['cat_title']?></option>
                            <?php
                            foreach($list_cat as $item)    {   
                            ?>
                            <option value="<?php echo $item['cat_id']?>"> <?php echo $item['cat_id']."-".$item['cat_title']?></option>
                            
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
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" <?php if($delete_product['trangthai']=='Chờ duyệt'){echo "checked";}?> >
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai" <?php if( $delete_product['trangthai']=='Công khai'){echo "checked";}?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div style="display: flex;">
                        <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="1" id="rules">
                        <label style="margin-left: 10px;"> Sản Phẩm nổi bật</label><br>
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