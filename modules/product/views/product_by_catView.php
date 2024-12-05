<?php
get_header();
?>
<link rel="stylesheet" href="public/css/product.css">
 <main id="main">
      <section class="td_product">
        <div class="min_wrap">
            <div class="category_product">
                <div class="cuahang">
                    <h3><?php echo $cat_product['cat_title']?></h3>
                    <div class="content"><a href="">Trang chủ / </a><?php echo $cat_product['cat_title']?></div>
                </div>
                <div class="box_search">
                    
                    <p class="result">Hiển thị tất cả <?php echo count($list_product) ?> kết quả</p>
                    <form action="">
                        <select id="order_by" name="list_order" form="carform">
                            <option value="volvo">Thứ tự mặc định</option>
                            <option value="saab">Thứ tự theo mức độ phổ biến</option>
                            <option value="opel">Thứ tự theo điểm đánh giá</option>
                            <option value="audi">Thứ tự theo giá: thấp đến cao</option>
                            <option value="audi">Thứ tự theo giá: cao xuống thấp</option>
                          </select>
                    </form>
                </div>
            </div>    
        </div>
      </section>
       
        <section class="product_list">
            <div class="min_wrap">
                <div class="product_category">
                    <div class="category">
                        <div class="title">Danh mục sản phẩm</div>
                        <ul class="cat_product">
                            <?php $list_product_cat=get_product_cat(); 
                            foreach($list_product_cat as $item){
                                $slug=create_slug($item['cat_title']);
                            ?>
                            <li class="cat_item">
                                <a href="<?php echo $slug."-dm".$item['cat_id'].".htm"?>"><?php echo $item['cat_title']?></a>
                                <span class="count">(<?php echo get_total_product_by_cat($item['cat_id']) ?>)</span>
                            </li>
                            <?php
                                }
                            ?>                                   
                        </ul>
                    </div>
                    <div class="list_product"> 
                        <?php if(!empty($list_product)){ ?>                       
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
                            <?php } else echo "Không tồn tại sản phẩm nào!"?>          
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </main>
<?php
get_footer();
?>
