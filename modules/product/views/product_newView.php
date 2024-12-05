<?php
get_header();
?>
 <link rel="stylesheet" href="public/css/product_new.css">
    <link rel="stylesheet" href="public/css/product.css">
<main id="main">  
        <section class="product_list">
            <div class="min_wrap">
                <div class="product_category">                 
                    <div class="list_product">                        
                        <div class="product">
                            
                        <?php foreach($list_product as $item) { 
                          $slug=create_slug($item['title']);?>
                                <div class="box_product">
                                <a href="<?php echo $slug."sp".$item['product_id'].".htm"?>"><div class="anh"><img style="height: 100% !important;" src="admin/public/images/<?php echo $item['img']?>" alt=""></div></a>
                                <div class="content_product">
                                    <p class="name"> <a href="<?php echo $slug."sp".$item['product_id'].".htm"?>" ><?php echo $item['title']?></a></p>
                                    <div class="price"><?php echo currency_format($item['price']) ?></div>
                                    <div class="add_cart"><a href="?mod=cart&action=add_cart&product_id=<?php echo $item['product_id']?>">Thêm vào giỏ hàng</a></div>
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