<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input type="text" name="post_title" class="form-control" id="title">
                    <?php echo form_error('post_title')?>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="post_description" class="form-control" id="content" cols="30" rows="5"></textarea>
                    <?php echo form_error('post_description')?>
                </div>
                <div class="form-group">
                    
                    <label for="desc">Nội dung Chi tiết</label>
                    <textarea name="post_detail" id="desc" class="textarea"></textarea>
                    <?php echo form_error('post_detail')?>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        
                    </div>
                    
                    <div class="mt-3"> <img id="image" width="300px" height="300px" src="public/images/img-thumb.png"></div>
                </div>           
                <div class="form-group" >
                            <label for="">Danh mục cha</label>
                            <select name='danhmuc_id' class='form-control'>
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
                                        
                                        $result .= '<option value="' . $v['danhmuc_id'] . '">' . str_repeat('---', $v['cap']-1) . ucfirst($v['ten_danhmuc']) . '</option>';
                                        
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
                            <?php echo form_error('danhmuc_id')?>
                </div>

                <div class="form-group">
                    <div style="display: flex;">
                        <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="2" id="rules">
                        <label style="margin-left: 10px;"> Tin tức nổi bật</label><br>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios1" value="Chờ duyệt" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trangthai" id="exampleRadios2" value="Công khai">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>



                <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
?>