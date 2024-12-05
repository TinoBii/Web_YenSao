<?php
get_header();

?>
<link rel="stylesheet" href="public/css/checkout_success.css">
<main id="main">
    <div class="min_wrap clearfix">    
        <div class="clearfix">
            <div style="width:100%;text-align:center;line-height: 30px;" class="thanhcong">
                <div ><strong style="font-size: 28px;color: green;">Đặt hàng thành công ! </strong></div>
                <div style="font-size: 14px; color: #000000c9;">Cảm ơn quý khách đã đặt hàng Hải sản của chúng tôi</div>
                <div style="font-size: 14px; color: #000000c9;">Đội ngũ chăm sóc khách hàng sẽ liên hệ sơm nhất có thể để xác nhận đơn hàng</div>
            </div>
            <div class="donhang">Mã đơn : <strong style="color: #000000c2;">#DH<?php echo $order['id_ddh']?></strong></div>
            <div class="thongtinkh">
                    <div class="khachhang pb-3"><i class="fa-solid fa-circle-user"></i> Thông tin khách hàng</div>
                    <table id="customers" class="w3-table w3-striped">
                        <thead>
                            <tr>                                          
                                <th scope="col">Tên Khách Hàng</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                                                    
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php $kh=get_kh_by_order($order['id_kh']);
                            ?>
                            <tr class="">
                                <td><?php echo $kh['HoTen']?></td>
                                <td><?php echo $order['diachidh'] ?></td>
                                <td><?php echo $kh['email']?></td>
                                <td><?php echo $kh['sdt']?></td>                      
                            </tr>
                        
                        </tbody>
                    </table>
            </div>
            <div class="thongtinsp">
                <div class="khachhang pb-3"><i class="fa-solid fa-circle-info"></i> Thông tin sản phẩm</div>
                <table id="customers" class="w3-table w3-striped">
                        <thead>
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
                                    <a style="color: #000 !important;" href="" title=""><img style="width:80px !important;height: 80px !important;" src="admin/public/images/<?php echo $product['img']?>" alt=""></a>
                                </td>
                                <td>#SP<?php echo $product['product_id']?></td>
                                <td ><a href="#"><?php echo $item['product_title']?></a></td>
                                <td><?php echo currency_format($product['price']) ?></td>
                                <td><?php echo $item['soluong'] ?></td>
                                <td><?php echo currency_format($item['DonGia']) ?></td>
                            </tr>
                            <?php
                            } }                  
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>
