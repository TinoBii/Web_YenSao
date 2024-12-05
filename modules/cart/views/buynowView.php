<?php
get_header();
?>

 <link rel="stylesheet" href="public/css/product.css">
<link rel="stylesheet" href="public/css/cart.css">
<link rel="stylesheet" href="public/css/checkout.css">
<script src="public/js/diachi.js" type="text/javascript"></script>
<main id="main">
        <section class="cart">
            <div class="min_wrap">
                    <div class="cart_box">
                        <div class="cart_product">
                            <form method="POST" action="" name="form-checkout">
                                <div class="section" id="customer-info-wp">
                                    <div class="section-head">
                                        <h1 class="section-title">Thông tin khách hàng</h1>
                                    </div>
                                    <div class="section-detail">
                                    
                                        <div class="form-row clearfix">
                                            <div class="form-col fl-left">
                                                <label for="fullname">Họ tên</label>
                                                <input type="text" name="hoten" value="<?php echo set_value('hoten')?>" id="fullname">
                                                <?php echo form_error('hoten')?>
                                            </div>
                                            <div class="form-col fl-right">
                                                <label for="email">Email</label>
                                                <input type="email" value="<?php echo set_value('email')?>" name="email" id="email">
                                                <?php echo form_error('email')?>
                                            </div>
                                        </div>
                                        <div class="form-row clearfix">
                                            <div class="form-col fl-left">
                                                <label for="province">Tỉnh/Thành phố</label>
                                                <select id="province" name="province" class="form-control">
                                                    <option value="">Chọn một tỉnh</option>
                                                    <!-- populate options with data from your database or API -->
                                                    <?php
                                                    
                                                    foreach($list_province as $row) {
                                                    ?>
                                                        <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-col fl-right">
                                                <label for="district">Quận/Huyện</label>
                                                <select id="district" name="district" class="form-control">
                                                    <option value="">Chọn một quận/huyện</option>
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="form-row clearfix">
                                            <div class="form-col fl-left">
                                                <label for="wards">Phường/Xã</label>
                                                <select id="wards" name="wards" class="form-control">
                                                    <option value="">Chọn một xã</option>
                                                </select>
                                            </div>
                                            <div class="form-col fl-right">
                                                <label for="address">Số nhà</label>
                                                <input type="text" value="<?php echo set_value('sonha')?>" name="sonha" id="address">
                                                <?php echo form_error('sonha')?>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="sdt">Số điện thoại</label>
                                            <input type="tel" name="sdt" value="<?php echo set_value('sdt')?>" id="phone" class="form-control">
                                            <?php echo form_error('sdt')?>
                                        </div>
                                    
                                        <div class="form-row clearfix">
                                            <div class="form-col fl-left">
                                                <label for="GhiChu">Ghi chú</label>
                                                <textarea name="GhiChu" value="<?php echo set_value('GhiChu')?>"></textarea>
                                            
                                            </div>
                                            <div class="form-col fl-right">
                                                <div id="payment-checkout-wp">
                                                <label for="GhiChu">Chọn hình thức thanh toán</label></label>
                                                    <ul id="payment_methods">
                                                        <li>
                                                            <input type="radio" id="direct-payment" name="payment_method" value="Thanh toán tại quầy">
                                                            <label class="payment" for="direct-payment">Thanh toán tại quầy</label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="payment-home" name="payment_method" value="Thanh toán tại nhà">
                                                            <label class="payment" for="payment-home">Thanh toán khi nhận hàng</label>
                                                        </li>
                                                    </ul>
                                                    <?php echo form_error('payment_method')?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="place-order-wp clearfix">
                                            <input name="btn-dathang" class="dathang" type="submit" id="order-now" value="Đặt hàng">
                                        </div>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                        <div class="cart_product_price">
                            <div class="section-head">
                                        <h1 class="section-title">Thông tin Sản phẩm</h1>
                                    </div>
                                <table>
                                    <tr>
                                    <th>SẢN PHẨM</th>
                                    <th class="mobile">GIÁ</th>
                                    
                                    <th class="mobile"> TẠM TÍNH</th>
                                
                                    </tr>
                                   
                                    <tr> 
                                    <td>
                                        <div class="anh_product"> 
                                            <img src="admin/public/images/<?php echo $product['img']?>" alt="">
                                            <p><?php echo $product['title']?></p></div>
                                    </td>
                                    <td class="mobile"><strong><?php echo currency_format($product['price']) ?></strong><i> x1 </td>
                                    <td class="mobile"><strong class="sub-total-<?php echo $product['product_id']?>"><?php echo currency_format($product['price']) ?></strong></td>
                                    
                                    </tr>
                                   
                                </table>
                                
                                </table>
                                <table cellspacing="0">
                                    <thead>
                                        <tr >
                                            <th style="text-align: center;" class="product-name" colspan="2" style="border-width:3px;">CỘNG GIỎ HÀNG</th>
                                        </tr>
                                    </thead>
                                </table>
                                <table cellspacing="0" class="shop_table shop_table_responsive">
                                    <tbody>
                                        <tr class="cart-subtotal" style="padding: 10px;">
                                            <th>Tạm tính</th>
                                            <td style="text-align: right;" data-title="Tạm tính"><span id="total-price" class="woocommerce-Price-amount amount"><bdi id="Provisional"><?php echo currency_format($product['price'])  ?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                                        </tr>                                                                                                  
                                        <tr class="order-total">
                                            <th>Tổng</th>
                                            <td style="text-align: right;" data-title="Tổng"><span id="total-price" class="woocommerce-Price-amount amount"><bdi id="total_cart" ><?php echo currency_format($product['price'])  ?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                                        </tr>                               
                                                                
                                    </tbody>
                                </table>
                           
                            <form style="margin-top: 20px;" action="">
                                    <div class="icon_km">
                                        <i class="fa-solid fa-tag"></i> <span>Phiếu ưu đãi</span>
                                    </div>
                                    <input placeholder="Mã ưu đãi" type="text" class="uudai"> <br>
                                    <input type="submit" class="apdung" value="Áp dụng">
                            </form>
                            </div>
                        </div>
                    </div>
                    
                   
            </div>
        </section>
   </main>
<?php
get_footer();
?>