<?php
get_header();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
        <div class="container-fluid py-4">
    <div class="row">
        <div class="col-sm-6">
           
         <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
        <div class="col-sm-6">
         <div class="row">
              <div class="col-sm-6">
                 <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                 <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(3)?></h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
                 </div>
             </div>
              <div class="col-sm-6">
                 <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                 <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(1)?></h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
                 </div>
             </div>
              <div class="col-sm-6">
                 <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo currency_format(get_total())?></h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                 </div>
             </div>
              <div class="col-sm-6">
                 <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                 <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo get_total_order_by_tt(4)?></h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
                 </div>
             </div>
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
                <?php  if(!empty($pagging)){  get_pagging1($num_page,$page,"?mod=order&action=Index");}?>
            </nav>
        </div>
    </div>

</div>
        </div>
</div>

<?php
$doanhThuCacThang = [];

for ($thang = 1; $thang <= 12; $thang++) {
    $doanhThuCacThang[] = get_doanhthu_thang($thang);
}
show_array($doanhThuCacThang);
?>

<script>
const xValues = [
    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 
    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
];

// Đưa mảng doanh thu từ PHP vào JavaScript thông qua json_encode
const yValues = <?php echo json_encode($doanhThuCacThang); ?>;

// Giả sử bạn muốn log ra để kiểm tra
console.log('X Values:', xValues);
console.log('Y Values:', yValues);

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:280}}],
    }
  }
});
</script>
<?php 
get_footer();
?>