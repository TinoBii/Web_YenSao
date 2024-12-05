<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form method="POST" action="?mod=product&action=add_cat" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="cat_title" id="name">
                            <?php if(!empty($error)){ echo form_error('cat_title');}?>
                        </div>
                        <div class="form-group" >
                            <label for="">Danh mục cha</label>
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

                        <div class="form-group">
                            <div style="display: flex;">
                                <input style="margin-bottom: 9px;" type="checkbox" name='noibat' value="2" id="rules">
                                <label style="margin-left: 10px;"> nổi bật</label><br>
                            </div>
                        </div>
                        <?php echo form_error('trangthai');?>
                        

                        <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                Danh sách danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            function has_child1($data,$id){
                                foreach($data as $v){
                                    if($v['cat_id_cha']==$id){
                                        return true;
                                    }
                                }
                                return false;
                            }     
                            function render_menu1($data,$parent_id=0,$level=0){
                                
                                
                                if($level==0){
                                    $result="";
                                }
                                else{
                                    $result="";
                                }
                                
                                foreach($data as $v){
                                    
                                    
                                    if($v['cat_id_cha']==$parent_id){
                                        $result .= '<tr>
                                        
                                        <td>' . str_repeat('---/ ', $v['level']) . ucfirst($v['cat_title']) . '</td>
                                        <td>' . $v['time'] . '</td>
                                        <td>' . $v['fullname'] . '</td>
                                        <td>
                                            <a href="?mod=product&action=edit_cat&cat_id=' . $v['cat_id'] . '"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                            <a href="?mod=product&action=delete_cat"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>  
                                        </td>
                                    </tr>';                                      
                                        if(has_child1($data,$v['cat_id'])){
                                            $result.=render_menu1($data,$v['cat_id'],$level+1);
                                        }
                                        
                                    }
                                }
                                
                                return $result;
                            }
                            echo render_menu1($list_cat)
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>