<?php
get_header();
?>

 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách Sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                <input type="text" id="Search" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
        <div class="analytic">
            <div>
                <a href="?mod=product&action=list_product" class="text-primary">Tất cả<span class="text-muted">(<?php echo get_total_product()?>)</span></a>
                <a href="?mod=product&action=list_product_trangthai&trangthai=1" class="text-primary">Đã đăng<span class="text-muted">(<?php echo get_total_product_congkhai()?>)</span></a>
                <a href="?mod=product&action=list_product_trangthai&trangthai=0" class="text-primary">Chờ xét duyệt<span class="text-muted">(<?php echo get_total_product_chuaduyet()?>)</span></a>
                <a href="?mod=product&action=list_product_garbage" class="text-primary">Thùng rác<span class="text-muted">(<?php echo get_total_product_rac()?>)</span></a>
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
                    <a href="?mod=product&action=add_product"><button type="submit" class="btn btn-success"><i style="color:#fff" class="plus-icon fas fa-plus-circle"></i> Thêm mới</button></a>
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
                        <th scope="col">Mã SP</th>
                        <th style="width: 20%;" scope="col">Danh mục</th>
                        <th scope="col">danhmuc</th>
                        <th scope="col">Tên SP</th>
                        <th scope="col">Gía</th>                      
                        <th scope="col">Người tạo - Ngày tạo</th>
                        <th scope="col">Hình ảnh slide</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt=0;
                    if(!empty($list_product)){  
                        foreach(array_reverse($list_product) as $item){
                    ?>
                    <tr class="Search">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row"><?php echo $stt;$stt++?></td>

                        <td>
                        <a href="?mod=images&action=add_img&product_id=<?php echo $item['product_id']?>" title=""><img width="120px;" height="120px;" src="public/images/<?php echo $item['img']?>" alt=""></a>
                        </td>
                        <td>#SP<?php echo $item['product_id']?></td>
                        <td>
                            <?php
                            $cap_names = [];
                            if (!empty($item['ten_cap1'])) {
                                $cap_names[] = $item['ten_cap1'];
                            }
                            if (!empty($item['ten_cap2'])) {
                                $cap_names[] = $item['ten_cap2'];
                            }
                            if (!empty($item['ten_cap3'])) {
                                $cap_names[] = $item['ten_cap3'];
                            }
                            if (!empty($item['ten_cap4'])) {
                                $cap_names[] = $item['ten_cap4'];
                            }

                            echo implode(' / ', $cap_names);
                            ?>
                        </td>
                        <td ><a href="#"><?php echo $item['ten_danhmuc']?></a></td>
                        <td ><a href="#"><?php echo $item['title']?></a></td>
                        <td><?php echo currency_format($item['price']) ?></td>
                        <td>
                            <?php echo $item['fullname']."<br>"?>
                            <?php echo $item['time']?>
                        </td>                       
                        <td >
                        <p><a href="?mod=images&action=add_img&product_id=<?php echo $item['product_id']?>" class="text-primary">(<?php echo count(get_list_img_by_id($item['product_id']))?>) hình slide</a></p>
                        </td>                       
                        <td>                           
                            <?php $action=$_GET['action'] ; 
                                if($action=='list_product'){
                            ?>
                            <a href="?mod=product&action=edit_product&product_id=<?php echo $item['product_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <a href="?mod=product&action=trash_can&product_id=<?php echo $item['product_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            <?php }
                            else if($action=='list_product_garbage'){
                            ?>
                            <a href="?mod=product&action=restore_product&product_id=<?php echo $item['product_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fa-solid fa-trash-can-arrow-up"></i></button></a>
                            <a href="?mod=product&action=delete_product&product_id=<?php echo $item['product_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            <?php }else{
                            ?>
                            <a href="?mod=product&action=edit_product&product_id=<?php echo $item['product_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <a href="?mod=product&action=trash_can&product_id=<?php echo $item['product_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
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
                <?php  if(!empty($pagging)){  get_pagging1($num_page,$page,"?mod=product&action=list_product");}?>
            </nav>
        </div>
    </div>
</div>
<?php
get_footer();
?>

