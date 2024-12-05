<?php
get_header();
?>
<script type="text/javascript" src="public/scripts/html5/drop.js"></script>
<script type="text/javascript" src="public/scripts/html5/set.js"></script>    
<div id="page-body" class="d-flex">
    <?php get_sidebar()?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kieu">Kiểu</label>
                                    <select name="kieu" class="form-control" id="kieu">
                                        <option value="0">Chọn kiểu</option>
                                        <option value="1" <?php echo set_value('kieu') == 1 ? 'selected' : ''; ?>>Giới thiệu</option>
                                        <option value="2" <?php echo set_value('kieu') == 2 ? 'selected' : ''; ?>>Sản phẩm</option>
                                        <option value="3" <?php echo set_value('kieu') == 3 ? 'selected' : ''; ?>>Tin tức</option>
                                        <option value="4" <?php echo set_value('kieu') == 4 ? 'selected' : ''; ?>>Chính sách</option>
                                    </select>
                                    <?php echo form_error('kieu'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="cap">Cấp</label>
                                    <select name="cap" class="form-control" id="cap">
                                        <option value="">Chọn cấp</option>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo set_value('cap') == $i ? 'selected' : ''; ?>>
                                                <?php echo "Cấp $i"; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php echo form_error('cap'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="ten_danhmuc">Tên danh mục</label>
                                    <input type="text" name="ten_danhmuc" class="form-control" value="<?php echo set_value('ten_danhmuc')?>" id="ten_danhmuc">
                                    <?php echo form_error('ten_danhmuc')?>
                                </div>

                                <div class="form-group">
                                    <label for="trangthai">Trạng thái</label>
                                    <div>
                                        <label>
                                            <input type="radio" name="trangthai" value="Công khai" <?php echo set_value('trangthai') == '1' ? 'checked' : ''; ?>> Công khai
                                        </label>
                                        <br>
                                        <label>
                                            <input type="radio" name="trangthai" value="0" <?php echo set_value('trangthai') == '0' ? 'checked' : ''; ?>> Không Công khai
                                        </label>
                                    </div>
                                    <?php echo form_error('trangthai')?>
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
                                <div class="form-group">
                                    <label for="noibat">Nổi bật</label>
                                    <select name="noibat" class="form-control" id="noibat">
                                        <option value="1" <?php echo (set_value('noibat') == '0') ? 'selected' : '' ?>>Không</option>
                                        <option value="2" <?php echo (set_value('noibat') == '1') ? 'selected' : '' ?>>Có</option>
                                    </select>
                                    <?php echo form_error('noibat')?>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="btn-upload" class="btn btn-primary">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
