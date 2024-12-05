<?php
get_header();
?> <link rel="stylesheet" href="public/css/index.css">
<link rel="stylesheet" href="public/css/product.css">
<link rel="stylesheet" href="public/css/post.css">
 <main id="main">  
        <section class="product_list">
            <div class="min_wrap">
                <div class="product_category">
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
                    </div>
                    <div class="list_product">                        
                        <div class="product">
                            <?php foreach($list_post as $item) {
                                 $slug=create_slug($item['post_title']);
                                ?>
                            <div class="box_product">
                                <div class="anh"><a href="<?php echo $slug."-tt".$item['post_id'].".htm"?>"><img src="admin/public/images/<?php echo $item['img']?>" alt=""></a> </div>
                                <div class="content_product">
                                   <h5 class="name"> <a href="<?php echo $slug."-tt".$item['post_id'].".htm"?>" ><?php echo $item['post_title'] ?></a></h5>
                                    <p class="content"><?php echo $item['post_description'] ?></p>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </main>
<?php
get_footer();
?>