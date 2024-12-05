<?php
get_header();
?>
    <div class="main">
        <div class="layout_collection">
            <div class="dg_dan">
                <div class="container">
                    <ul class="cont_dg_dan">
                        <li class="dg_dan_home">
                            <a href="" title="Trang chủ">
                                <span>
                                    Trang chủ
                                </span>
                            </a>
                            <span class="mr_lr">
                                &nbsp;
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                                    <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class="">
                                    </path>
                                </svg>
                                &nbsp;
                            </span>
                        </li>
                        <li>
                            <strong>
                                <span>
                                    Tất cả sản phẩm
                                </span>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="content_lay_collection">
                    <div class="banner_collection">
                        <a href="" title="click xem ngay" class="duration-300 has-aspect-1">
                            <picture>
                                <img alt="Banner top" class="lazyload loaded" src="public/images/collection_banner.jpg">
                            </picture>
                        </a>
                    </div>
                    <div class="titl_collection">
                        <div class="det_title_cltion">
                            <h1><?php echo $danhmuc_detail['ten_danhmuc']?></h1>
                            <div class="title-separator">
                                <div class="separator-center"></div>
                            </div>
                        </div>
                        <div class="list_category_cltion">
                            <div class="menu_list_cltion">
                                <?php 
                                    $list_danhmuc = get_list_categories_by_catid_cha($danhmuc_detail['danhmuc_id']);
                                    foreach($list_danhmuc as $danhmuc_sp){
                                ?>
                                <a class="cltion_menu_item duration-300 " href="?mod=home&action=loadmenu&danhmuc_id=<?php echo $danhmuc_sp['danhmuc_id']?>" title="Tổ yến">
                                    <div class="cate-info-title"><?php echo $danhmuc_sp['ten_danhmuc']?></div>
                                </a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="desc_category_cltion">
                            <p>
                                <strong>Sudes Nest</strong> đến nay đã chiếm trọn niềm tin của khách hàng bởi chất lượng - tinh tế - hợp khẩu vị trong từng dòng sản phẩm về Yến sào. 
                                <strong>Sudes Nest</strong> luôn mang đến cho quý khách hàng những sản phẩm chất lượng nhất - tốt nhất - tinh hoa nhất với đội ngũ chuyên gia nghiên cứu dinh dưỡng hàng đầu Việt Nam và luôn đầu tư dây chuyền sản xuất công nghệ cao, hiện đại, quy mô sản xuất lớn.
                            </p>
                        </div>
                    </div>
                    <div class="block_collection">
                        <div class="view_all_product">
                            <div class="filter_container">
                                <div class="cont_fil_contai">
                                    <div class="left_cont_fil">
                                        <a class="btn btn-outline btn-filter" title="Bộ lọc">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"></path>
                                            </svg>
                                            Bộ lọc
                                            <span class="count-filter-val">0</span>
                                        </a>
                                    </div>
                                    <div class="right_cont_fil">
                                        <h3>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"></path>
                                                <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"></path>
                                            </svg>
                                            Xếp theo
                                        </h3>
                                        <ul>
                                            <li class="btn-quick-sort default active">
                                                <a href="" title="Mặc định"><i></i>Mặc định</a>
                                            </li>
                                            <li class="btn-quick-sort alpha-asc">
                                                <a href="" title="Tên A-Z"><i></i>Tên A-Z</a>
                                            </li>
                                            <li class="btn-quick-sort alpha-desc">
                                                <a href="" title="Tên Z-A"><i></i>Tên Z-A</a>
                                            </li>
                                            <li class="btn-quick-sort position-desc">
                                                <a href="" title="Hàng mới"><i></i>Hàng mới</a>
                                            </li>
                                            <li class="btn-quick-sort price-asc">
                                                <a href="" title="Giá thấp đến cao"><i></i>Giá thấp đến cao</a>
                                            </li>
                                            <li class="btn-quick-sort price-desc">
                                                <a href="" title="Giá cao xuống thấp"><i></i>Giá cao xuống thấp</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="block_pro_cltion">
                                <div class="row_pro_cltion">
                                    <?php 
                                        $list_product_by_cat = get_list_pro_by_cat_id($danhmuc_detail['danhmuc_id'], 20);
                                        if(!empty($list_product_by_cat)){
                                            foreach($list_product_by_cat as $product){
                                            $slug=create_slug($product['title']);
                                    ?>
                                    <div class="col_pro_cltion">
                                        <div class="item_product_main">
                                                <form action="" method="post" class="form_product_sale duration-300">
                                                    <?php if ($product['discount'] > 0){ ?>
                                                        <span class="flash-sale"> - <?php echo $product['discount']?>% </span>
                                                    <?php } ?>
                                                    <div class="tag-promo" title="Quà tặng">
                                                        <img  src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/tag_pro_icon.svg?1717814629369" data- src="public//bizweb.dktcdn.net/100/506/650/themes/944598/assets/tag_pro_icon.svg?1717814629369" alt="Quà tặng" class="lazyload loaded">
                                                        <div class="promotion-content">
                                                            <div class="line-clamp-5-new" title="- Tặng 1 túi giấy xách đi kèm - 1 Hộp đường phèn ">
                                                            <p>
                                                            <span style="letter-spacing: -0.2px;">- Tặng 1 túi giấy xách đi kèm <br>- 1 Hộp đường phèn </span>
                                                            </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-thumbnail">
                                                        <a class="image_thumb scale_hover" href="<?php echo $slug."sp".$product['product_id'].".htm"?>" title="">
                                                            <img class="lazyload duration-300" src="admin/public/images/<?php echo $product['img']?>" >
                                                        </a>
                                                    </div>  
                                                    <div class="product-info">
                                                        <div class="name-price">
                                                            <h3 class="product-name line-clamp-2-new">
                                                                <a href="<?php echo $slug."sp".$product['product_id'].".htm"?>" title=""><?php echo $product['title']?></a>
                                                            </h3>
                                                            <div class="product-price-cart">
                                                                <?php if ($product['price_discount'] > 0){ ?>
                                                                    <span class="compare-price"><?php echo currency_format($product['price_discount'])?></span>
                                                                <?php } ?>
                                                                <span class="price"><?php echo currency_format($product['price'])?></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-button">
                                                            <input type="hidden" name="variantId" value="110202248" />
                                                            <button class="btn-cart btn-views add_to_cart btn btn-primary " title="Thêm vào giỏ hàng">
                                                                <span>Thêm vào giỏ</span>
                                                                <svg enable-background="new 0 0 32 32" height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"/></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"/></g></g></svg>
                                                            </button>
                                                            <a href="javascript:void(0)" class="setWishlist btn-views btn-circle" data-wish="set-qua-2010-maneli-1-boi-bo-suc-khoe-duong-nhan" tabindex="0" title="Thêm vào yêu thích">
                                                                <img width="25" height="25"  src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/heart.png?1717814629369" alt="Thêm vào yêu thích"/> 
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php }}?>
                                </div>
                            </div>
                            <div class="next_page">
                                <nav class="page_nav">
                                    <ul class="pagination clearfix">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">«</a>
                                        </li>
                                        <li class="active page-item disabled">
                                            <a class="page-link" style="pointer-events:none">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link link-next-pre" title="2">»</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
get_footer();
?>