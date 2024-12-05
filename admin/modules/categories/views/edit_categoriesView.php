<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php get_sidebar()?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Chỉnh sửa danh mục
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cap">Cấp</label>
                                    <select name="cap" class="form-control" id="cap">
                                        <option value="">Chọn cấp</option>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($edit_categories['cap'] == $i) ? 'selected' : ''; ?>>
                                                <?php echo "Cấp $i"; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php echo form_error('cap'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="kieu">Kiểu</label>
                                    <select name="kieu" class="form-control" id="type">
                                        <option value="1" <?php echo ($edit_categories['kieu'] == '1') ? 'selected' : ''; ?>>Giới thiệu</option>
                                        <option value="2" <?php echo ($edit_categories['kieu'] == '2') ? 'selected' : ''; ?>>Sản phẩm</option>
                                        <option value="3" <?php echo ($edit_categories['kieu'] == '3') ? 'selected' : ''; ?>>Tin tức</option>
                                        <option value="4" <?php echo ($edit_categories['kieu'] == '4') ? 'selected' : ''; ?>>Chính sách</option>
                                        <!-- Thêm các tùy chọn khác nếu cần -->
                                    </select>
                                    <?php echo form_error('kieu')?>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên danh mục</label>
                                    <input type="text" name="ten_danhmuc" class="form-control" value="<?php echo $edit_categories['ten_danhmuc']?>" id="categories-name">
                                    <?php echo form_error('ten_danhmuc')?>
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group" >
                                    <label for="">Danh mục cha</label>
                                    <select name='danhmuc_id_cha' class='form-control'>
                                    <option value="0">--Chọn--</option>
                                    <?php
                                        $data = db_fetch_array("SELECT * FROM `tbl_danhmuc`");       

                                        function has_child($data,$id){
                                            foreach($data as $v){
                                                if($v['danhmuc_id_cha']==$id){
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
                                                if($v['danhmuc_id_cha']==$parent_id){       
                                                    $result .= '<option value="' . $v['danhmuc_id'] . '">' . str_repeat('---/ ', $v['cap']-1) . ucfirst($v['ten_danhmuc']) . '</option>';                                      
                                                    if(has_child($data,$v['danhmuc_id'])){
                                                        $result.=render_menu($data,$v['danhmuc_id'],$level+1);
                                                    }
                                                    
                                                }
                                            }
                                            
                                            return $result;
                                        }
                                        echo render_menu($data)
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trangthai" id="status_pending" value="Chờ duyệt" <?php if($edit_categories['trangthai']=='Chờ duyệt'){echo "checked";}?> >
                                <label class="form-check-label" for="status_pending">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trangthai" id="status_public" value="Công khai" <?php if($edit_categories['trangthai']=='Công khai'){echo "checked";}?>>
                                <label class="form-check-label" for="status_public">
                                    Công khai
                                </label>
                            </div>
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
