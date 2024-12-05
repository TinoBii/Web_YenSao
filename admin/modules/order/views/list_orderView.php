<?php
get_header();
?>

<div id="page-body" class="d-flex">
        <?php get_sidebar()?>
    <div id="wp-content">
         <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách đơn hàng</h5>
                    <div class="form-search form-inline">
                        <form action="#">
                            <input type="" id="Search" class="form-control form-search" placeholder="Tìm kiếm">
                            <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="?mod=order&action=list_order" class="text-primary">Tất cả<span class="text-muted">(<?php echo get_total_order_by_tt(0)?>)</span></a>
                        <a href="?mod=order&action=list_order_trangthai&trangthai=1" class="text-primary">Đang xử lý<span class="text-muted">(<?php echo get_total_order_by_tt(1)?>)</span></a>
                        <a href="?mod=order&action=list_order_trangthai&trangthai=2" class="text-primary">Đang vận chuyển<span class="text-muted">(<?php echo get_total_order_by_tt(2)?>)</span></a>
                        <a href="?mod=order&action=list_order_trangthai&trangthai=3" class="text-primary">Thành công<span class="text-muted">(<?php echo get_total_order_by_tt(3)?>)</span></a>
                        <a href="?mod=order&action=list_order_trangthai&trangthai=4" class="text-primary">Hủy đơn<span class="text-muted">(<?php echo get_total_order_by_tt(4)?>)</span></a>
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

                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Khách hàng</th>
                            
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
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
                            if(!empty($list_order)){
                            foreach(array_reverse($list_order) as $item){
                                $stt++;
                                $kh=get_kh_by_order($item['id_kh']);
                                $tong_sl=get_sl_by_order($item['id_ddh']);
                            ?>
                            <tr class="Search">
                                <th scope="row"><?php echo $stt?></th>
                                <td>#DH<?php echo $item['id_ddh']?></td>
                                <td>
                                    <?php echo ucwords($kh['HoTen'])."<br>".$kh['sdt']?>
                                
                                </td>
                            
                                <td><?php echo $tong_sl['soluong']?></td>
                                <td><?php echo currency_format($tong_sl['tong'])?></td>
                                <td><span class="badge badge-warning"><?php echo $item['trangthai']?></span></td>
                                <td><?php echo $item['NgayDat']?></td>
                                <td>
                                    <a href="?mod=order&action=detail_ctddh&id_ddh=<?php echo $item['id_ddh']?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="?mod=order&action=delete_order&id_ddh=<?php echo $item['id_ddh']?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            }}
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