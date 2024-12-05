<?php
get_header();
?>
 <link rel="stylesheet" href="public/css/product.css">
<link rel="stylesheet" href="public/css/cart.css">
<main id="main">
        <section class="cart">
            <div class="min_wrap">
            <?php if(!empty($list_product_inCart)){?>
                <div class="cart_box">
                    <div class="cart_product">
                        <table>
                            
                            <tr>
                              <th>SẢN PHẨM</th>
                              <th class="mobile">GIÁ</th>
                              <th  style="width: 20%;">SỐ LƯỢNG</th>
                              <th class="mobile"> TẠM TÍNH</th>
                              <th ></th>
                            </tr>
                            <?php foreach($list_product_inCart as $item){ ?>
                            <tr> 
                              <td>
                                <div class="anh_product"> 
                                    <img src="admin/public/images/<?php echo $item['product_thumb']?>" alt="">
                                    <p><?php echo $item['product_title']?></p></div>
                              </td>
                              <td class="mobile"><strong><?php echo currency_format($item['price']) ?></strong></td>
                              <td ><input data_id="<?php echo $item['product_id'] ?>" class="num-order" min="1" max="30" value="<?php echo $item['qty']?>" type="number"></td>
                              <td class="mobile"><strong class="sub-total-<?php echo $item['product_id']?>"><?php echo currency_format($item['sub_total']) ?></strong></td>
                              <td>
                                <a href="?mod=cart&action=delete&id=<?php echo $item['product_id'] ?>"><i class="fa-solid fa-trash"></i></a>    
                              </td>
                            </tr>
                            <?php } ?>
                          </table>
                          <div class="btn_cart">
                            <a href="trang-chu.htm"><button class="view_product" type="submit"> ← TIẾP TỤC XEM SẢN PHẨM</button>
                            </a>
                            
                            <input type="submit" value="CẬP NHẬT GIỎ HÀNG">
                          </div>
                    </div>
                    <div class="cart_product_price">
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
                                    <td style="text-align: right;" data-title="Tạm tính"><span id="total-price" class="woocommerce-Price-amount amount"><bdi id="Provisional"><?php echo currency_format(get_total_cart())  ?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                                </tr>                                                                                                  
                                <tr class="order-total">
                                    <th>Tổng</th>
                                    <td style="text-align: right;" data-title="Tổng"><span id="total-price" class="woocommerce-Price-amount amount"><bdi id="total_cart" ><?php echo currency_format(get_total_cart())  ?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                                </tr>                               
                                                         
                            </tbody>
                        </table>
                       <a class="check_out" href="thanh-toan.htm">Tiến hành thanh toán</a>
                       <form style="margin-top: 20px;" action="">
                            <div class="icon_km">
                                <i class="fa-solid fa-tag"></i> <span>Phiếu ưu đãi</span>
                            </div>
                            <input placeholder="Mã ưu đãi" type="text" class="uudai"> <br>
                            <input type="submit" class="apdung" value="Áp dụng">
                       </form>
                    </div>
                </div>
                
            <?php }else{?>
            <div style="width:100%;text-align:center" class="anh">
                <img style="width: 50%; height: 270px !important;" src="public/img/empty_cart.jpg" alt="">
            </div>   
            <?php }?>         
            </div>
        </section>
   </main>
<?php
get_footer();
?>
