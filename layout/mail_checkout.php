<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .row {
    display: flex;
    width: 100%;
    justify-content: space-between;
    }

    .col-sm-6 {
        width: 50%;
    }
    .container.px-5 {
    /* padding: 41px; */
    padding: 10px 200px 10px 200px;
    color: #000 !important;
}
.table tr td {
    vertical-align: middle;
}

.mail_checkout.p-4 {
    padding: 30px;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td ,tr {
  border-top: 1px solid #00000036;
  text-align: left;
  padding: 8px;
}
.im {
    color: #000000 !important;
}
/* tr:nth-child(even) {background-color: #f2f2f2;} */
   </style>
    <title>Document</title>
</head>
<body>
  <?php $order=get_ddh_by_id($id_ddh);?>
    <div class="container px-5">
        <div  style="line-height: 30px;background: #f9f9f9;" class="mail_checkout p-4">
             <div style="font-size: 20px;text-align:center"> <strong>Cảm ơn quý khách đã đặt hàng tại SEA FOOD</strong></div>
            <p>SEA FOOD rất vui thông báo đơn hàng <strong>#DH<?php echo $order['id_ddh']?></strong> của quý khách đã được tiếp nhận và đang trong quá trình xử lý,SEA FOOD sẽ thông báo đến quý khách ngay khi đơn hàng chuẩn bị được giao </p>
            <div style="color: #359ad4;font-size:16px;border-bottom: 1px solid;"><strong>THÔNG TIN ĐƠN HÀNG</strong><span>( <?php echo $order['NgayDat']?> )</span></div>
            <div class="row">
            <?php $kh=get_kh_by_order($order['id_kh']);
                    ?>
                <div class="col-sm-6">
                    <div> <strong>Thông tin thanh toán</strong></div>
                    <div><strong>Họ tên : </strong><?php echo $kh['HoTen']?></div>
                    <div><strong>Email : </strong><?php echo $kh['email']?></div>
                    <div><strong>Số điện thoại : </strong><?php echo $kh['sdt']?></div>
                    
                </div>
                <div class="col-sm-6">
                    <div><strong>Địa chỉ giao hàng</strong> </div>
                    <div><strong>Họ tên : </strong><?php echo $kh['HoTen']?></div>
                    <div><strong>Email : </strong><?php echo $kh['email']?></div>
                    <div><strong>Địa chỉ giao hàng : </strong><?php echo $order['diachidh']?></div>
                    <div><strong>Số điện thoại : </strong><?php echo $kh['sdt']?></div>
                </div>
            </div>
            <div><strong>Phương thức thanh toán:</strong> Thanh toán bằng tiền mặt khi nhận hàng</div>
            <div><strong>Thời gian giao hàng dự kiến:</strong> Dự kiến giao hàng tỏng vòng từ 3 - 5 ngày</div>
            <div><strong>Phí vận chuyển:</strong> 30.000đ</div>
            <div style="color: #359ad4;font-size:16px;border-bottom: 1px solid;"><strong>CHI TIẾT ĐƠN HÀNG</strong> </div>
                <table style="margin-top: 18px;" class="table text-left">
                  <thead style="background:#00000030;" class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                        
                        <th scope="col">Ảnh</th>
                        <th scope="col">Mã SP</th>
                        <th scope="col">Tên SP</th>
                        <th scope="col">Gía</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>   
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                  $ctddh=get_ctddh_by_order($order['id_ddh']);
                    if(!empty($ctddh)){
                        $stt=1;
                        foreach($ctddh as $item){
                            $product=get_sp_by_id_ctddh($item['id_product']);
                    ?>
                    <tr class="">
                       
                        <td scope="row"><?php echo $stt;$stt++?></td>
                        <td>
                          
                           <?php 
                            $img=$product['img'];
                            $mail->AddEmbeddedImage("admin/public/images/{$img}", "{$img}", "{$img}"); 
                            ?>
                            <a href="" title=""><img width="120px" style="display:block !important;"src=" cid:<?php echo $img?>" alt=""></a>
                        </td>

                       
                        <td>#SP<?php echo $product['product_id']?></td>
                        <td ><a href="#"><?php echo $item['product_title']?></a></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $item['soluong'] ?></td>
                        <td><?php echo currency_format($item['DonGia']) ?></td>
                        
                    </tr>
                    <?php
                    } }                  
                    ?>
                  
                  </tbody>
                </table>
                <?php  $tong_sl=get_sl_by_order($order['id_ddh']);?>
                  <div class="tongtien" style="width:100%;text-align: end;">
                      <div> <strong>Tổng tiền</strong> :<span> <?php echo currency_format($tong_sl['tong'])?></span></div>
                  </div>
        </div>
       

    </div>
</body>
</html>