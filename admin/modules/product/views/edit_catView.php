<?php
get_header();
?>
<div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
        <div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Chỉnh sửa danh mục
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                      
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" value="<?php echo $edit_cat['cat_title'] ?>" name="cat_title" id="name">
                           
                        </div>
                        <div class="form-group" >
                            <label for="">cha</label>
                            <select name='level' class='form-control'>
                            <option value="0">--Chọn--</option>
                            <?php
                            $data = db_fetch_array("SELECT * FROM `tbl_loaiproduct`");       

                            function has_child($data,$id){
                                foreach($data as $v){
                                    if($v['cat_id_cha']==$id){
                                        return true;
                                    }
                                }
                                return false;
                            }
                            function render_menu($data,$parent_id=0,$level=0){

                                if($level==0){
                                    $result="";
                                }
                                else{
                                    $result="";
                                }
                                foreach($data as $v){
                                    if($v['cat_id_cha']==$parent_id){       
                                        $result .= '<option value="' . $v['cat_id'] . '">' . str_repeat('---/ ', $v['level']) . ucfirst($v['cat_title']) . '</option>';                                      
                                        if(has_child($data,$v['cat_id'])){
                                            $result.=render_menu($data,$v['cat_id'],$level+1);
                                        }
                                        
                                    }
                                }
                                
                                return $result;
                            }
                            echo render_menu($data)
                            ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh danh mục</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>                        
                            </div>
                            <div class="mt-3"> <img id="image" width="150px" height="150px" src="public/images/img-thumb.png"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" <?php if($edit_cat['trangthai']=='Chờ duyệt') {echo 'checked';} ?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai" <?php if($edit_cat['trangthai']=='Công khai') {echo 'checked';}?>>
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                            <?php echo form_error('trangthai')?>
                        
                        </div>
                        <div class="form-group">
                            <div style="display: flex;">
                                <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="2" id="rules">
                                <label style="margin-left: 10px;"> nổi bật</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="display: flex;">
                                <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="1" id="rules">
                                <label style="margin-left: 10px;"> Không nổi bật</label><br>
                            </div>
                        </div>
                        <button type="submit" name="btn-edit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

</div>

<?php
get_footer();
?>