<?php
get_header();
?>
<link rel="stylesheet" href="public/css/product.css">
<link rel="stylesheet" href="public/css/post.css">
<link rel="stylesheet" href="public/css/detail_product.css">
<main id="main">
        <section class="product_list">
                <div class="min_wrap">
                    <div class="product_category">                  
                        <div class="product_detail">
                          <h2>  <?php echo $post_detail['post_title'] ?></h2>  <br>
                            <?php echo $post_detail['post_detail'] ?>
                        </div>
                        <div class="category">
                            <div class="title">TƯ VẤN ĐẶT HÀNG</div>
                            <div class="icon-box-text">
                                    <div class="box">
                                        <div class="logo"><img src="public/img/icon1.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>SẢN PHẨM AN TOÀN</h3>
                                            <P>Cam kết chất lượng. </P>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="logo"><img src="public/img/icon_1.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>SẢN PHẨM AN TOÀN</h3>
                                            <P>Cam kết chất lượng. </P>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="logo"><img src="public/img/icon_2.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>ĐỔI TRẢ HÀNG</h3>
                                            <P>Nhanh chóng, rõ ràng.</P>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="logo"><img src="public/img/icon_3.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>QUY CÁCH RÕ RÀNG</h3>
                                            <P>Sạch và tiện lợi</P>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="logo"><img src="public/img/icon_4.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>MIỄN PHÍ GIAO HÀNG</h3>
                                            <P>Cho hóa đơn từ 500.000đ</P>
                                        </div>
                                    </div>
                                </div>
                                <div  class="img_shop">
                                    <img src="public/img/nha-hang.jpg" alt="">
                                    <b>NHÀ HÀNG QUÁN ĂN</b>
                                    <p>Liên hệ qua số <a href="http://">0999.999.999</a> để được tư vấn và báo giá tốt</p>
                                </div>
                                <div class="product_noibat">
                                <div class="box_product">
                                    <div class="anh"><img src="public/img/product_1.jpg" alt=""></div>
                                    <div class="content_product">
                                        <p class="name"> <a href="" >Tôm càng Xanh sống</a></p>
                                        <div class="price">480.000đ</div>
                                        <div class="add_cart"><a href="">Thêm vào giỏ hàng</a></div>
                                    </div>
                                </div>
                                <div class="box_product">
                                    <div class="anh"><img src="public/img/product_2.jpg" alt=""></div>
                                    <div class="content_product">
                                        <p class="name"> <a href="" >Ghẹ sống (4-5 con)</a></p>                            
                                        <div class="price">80.000đ</div>
                                        <div class="add_cart"><a href="">Thêm vào giỏ hàng</a></div>
                                    </div>
                                </div>
                                
                                <div class="box_product">
                                    <div class="anh"><img src="public/img/product_4.jpg" alt=""></div>
                                    <div class="content_product">
                                        <p class="name"> <a href="" >Tôm Hùm Baby sống</a></p>
                                        <div class="price">790.000đ</div>
                                        <div class="add_cart"><a href="">Thêm vào giỏ hàng</a></div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                    </div>
                </div>
        </section>     
    </main>
<?php
get_footer();
?>