<?php
get_header();
?>
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">

    <div class="card">
   
        <div class="card-header font-weight-bold">
            Xóa đơn hàng
        </div>
        <div class="card-body">
            <form method="POST">
      <div class="row">
        <div class="col-sm-9">
            <div class="thongtin">
                <div class="trangthai">
                <?php if(!empty($_SESSION['successMsg'])): ?>
                <div id="msgAlert" class="alert alert-success" role="alert">
                    <?php echo $_SESSION['successMsg']; ?>
                </div>
            <?php endif; ?>
                    <div class="trangthai"><i class="fa-solid fa-signal"></i>  Trạng thái đơn hàng</div>
                    <form method="post">
                 
                    <div class="form-action form-inline py-3">
                        <select name="trangthai" class="form-control mr-1" id="">
                            <option value="Cập nhật trạng thái đơn hàng">Cập nhật trạng thái đơn hàng</option>
                            <option value="Đang xử lý" <?php if($ddh['trangthai']=='Đang xử lý'){echo "selected";}?>>Đang xử lý</option>
                            <option value="Đang vận chuyển" <?php if($ddh['trangthai']=='Đang vận chuyển'){echo "selected";}?>>Đang vận chuyển</option>
                            <option value="Thành công" <?php if($ddh['trangthai']=='Thành công'){echo "selected";}?>>Thành công</option>
                            <option value="Hủy đơn" <?php if($ddh['trangthai']=='Hủy đơn'){echo "selected";}?>>Hủy đơn</option>
                            
                        </select>
                        <!-- <input type="submit" name="btn-trangthai" value="Cập nhật" class="btn btn-primary"> -->
                    </div>
                    </form>
                </div>
                <div class="sanpham">
                    <div class="ttsanpham"><i class="fa-solid fa-circle-info"></i> Thông tin sản phẩm</div>
                    <table class="table table-striped table-checkall text-center">
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
                    $ctddh=get_ctddh_by_order($ddh['id_ddh']);
                    if(!empty($ctddh)){
                        $stt=1;
                        foreach($ctddh as $item){
                            $product=get_sp_by_id_ctddh($item['id_product']);
                    ?>
                    <tr class="Search">
                       
                        <td scope="row"><?php echo $stt;$stt++?></td>

                        <td>
                            <a href="" title=""><img width="80px;" src="public/images/<?php echo $product['img']?>" alt=""></a>
                        </td>
                        <td>#SP<?php echo $product['product_id']?></td>
                        <td ><a href="#"><?php echo $item['product_title']?></a></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $item['soluong'] ?></td>
                        <td><?php echo currency_format($item['DonGia']) ?></td>
                        
                    </tr>

                    <?php
                    
                    }
                        
                    }
                  
                    ?>

                </tbody>
            </table>
            <?php  $tong_sl=get_sl_by_order($ddh['id_ddh']);?>
            <div class="tongtien" style="width:100%;text-align: end;">
                <div> <strong>Tổng tiền</strong> :<span> <?php echo currency_format($tong_sl['tong'])?></span></div>
            </div>
            
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="kh">
                <div class="khachhang pb-3"><i class="fa-solid fa-circle-user"></i> Khách hàng</div>
                <div class="thongtinkh p-2" style="line-height: 33px;border: 2px solid #00000029; border-radius: 5px;">
                   <?php $kh=get_kh_by_order($ddh['id_kh']);?> 
                    <div><strong>Họ tên khách hàng</strong></div>
                    <div><?php echo $kh['HoTen']?></div>
                    <div><strong>Số điện thoại</strong></div>
                    <div><?php echo $kh['sdt']?></div>
                    <div><strong>Email</strong></div>
                    <div><?php echo $kh['email']?></div>
                    <div><strong>Địa chỉ</strong></div>
                    <div><?php echo $ddh['diachidh']?></div>
                    <div><strong>Ngày đặt hàng</strong></div>
                    <div><?php echo $ddh['NgayDat']?></div>
                    <div><strong>
                </div>
                Chú thích</strong></div>
            </div>
        </div>
      
      <input type="submit" name="btn-delete" value="Xác nhận xóa" class="btn btn-danger">
      </form>
    </div>
    </div>
</div>
<?php
get_footer();
?>