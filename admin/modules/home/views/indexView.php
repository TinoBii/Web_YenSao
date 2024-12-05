<?php
get_header();
?>

<div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
        <div class="container-fluid py-4">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(3)?></h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(1)?></h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo currency_format(get_total())?></h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(4)?></h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
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
                    $stt=0;
                    if(!empty($list_order)){
                    foreach(array_reverse($list_order) as $item){
                        $stt++;
                        $kh=get_kh_by_order($item['id_kh']);
                        $tong_sl=get_sl_by_order($item['id_ddh']);
                    ?>
                    <tr>
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
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>
        </div>
</div>
<?php
get_footer();
?>