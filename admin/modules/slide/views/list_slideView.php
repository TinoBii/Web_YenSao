<?php
get_header();

?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách Slide</h5>
            <div class="form-search form-inline">
                <form action="#">
                <input type="text" id="Search" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="?mod=slide&action=list_slide" class="text-primary">Tất cả<span class="text-muted">(<?php echo get_total_slide()?>)</span></a>
                <a href="?mod=slide&action=list_slide_trangthai&trangthai=1" class="text-primary">Đã đăng<span class="text-muted">(<?php echo get_total_slide_congkhai()?>)</span></a>
                <a href="?mod=slide&action=list_slide_trangthai&trangthai=0" class="text-primary">Chờ xét duyệt<span class="text-muted">(<?php echo get_total_slide_chuaduyet()?>)</span></a>
                <a href="?mod=slide&action=list_slide_garbage" class="text-primary">Thùng rác<span class="text-muted">(<?php echo get_total_slide_rac()?>)</span></a>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-6">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option>Tác vụ 1</option>
                            <option>Tác vụ 2</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                </div>
                <div style="text-align:end" class="col-sm-6 ">
                    <a href="?mod=slide&action=add_slide"><button type="submit" class="btn btn-success"><i style="color:#fff" class="plus-icon fas fa-plus-circle"></i> Thêm mới</button></a>

                </div>
            </div>
            <?php if(!empty($_SESSION['successMsg'])): ?>
                <div id="msgAlert" class="alert alert-success" role="alert">
                    <?php echo $_SESSION['successMsg']; ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped table-checkall text-center">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Link</th>
                        <th scope="col">Trạng thái</th>      
                        <th scope="col">Người tạo - Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($pagging)){
                        $num_page=$pagging['num_page'];
                        $page=$pagging['page'];
                        $start=$pagging['start'];
                        $stt=$start;
                        echo "Trang số : ".$page.'<br>';
                        }
                        else{
                            $stt=1;
                        }
                     if(!empty($list_slide)){
                       
                        foreach(array_reverse($list_slide) as $item){
                            
                    ?>
                    <tr class="Search">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row"><?php echo $stt;$stt++?></td>               
                        <td>
                            <a href="" title=""><img width="150px;" src="public/images/<?php echo $item['img']?>" alt=""></a>
                        </td>           
                        <td><a href="#"><?php echo $item['slide_title']?></a></td>
                        <td style="width: 26%;"><a style=" display: -webkit-box;
  -webkit-line-clamp:2;
  -webkit-box-orient: vertical;
  overflow: hidden;"><?php echo $item['mota']?></td>
                        <td><a href="#"><?php echo $item['url']?></a></td>
                        <td><?php echo $item['trangthai']?></td>
                        <td>
                            <?php echo $item['fullname']."<br>"?>
                            <?php echo $item['time']?>
                           
                           
                        </td>
                       
                        <td>
                            <?php $action=$_GET['action'] ; 
                                if($action=='list_slide'){
                            ?>
                            <a href="?mod=slide&action=edit_slide&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <a href="?mod=slide&action=trash_can&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            <?php }
                            else if($action=='list_slide_garbage'){
                            ?>
                             <a href="?mod=slide&action=restore_slide&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fa-solid fa-trash-can-arrow-up"></i></button></a>
                            <a href="?mod=slide&action=delete_slide&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            <?php }else{
                            ?>
                             <a href="?mod=slide&action=edit_slide&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <a href="?mod=slide&action=trash_can&slide_id=<?php echo $item['slide_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            <?php }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                        
                    }
                    else{
                        echo "Danh sách rỗng";
                    }
                    ?>

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <?php  if(!empty($pagging)){  get_pagging1($num_page,$page,"?mod=slide&action=list_slide");}?>
            </nav>
        </div>
    </div>
</div>
<?php
get_footer()
?>