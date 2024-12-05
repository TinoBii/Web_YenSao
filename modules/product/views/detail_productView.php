<?php
get_header();
?>
<div class="main">
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
                        <a class="changeurl" href="" title="">
                            <span>
                                <?php 
                                    $categories=get_cat_by_product($product_detail['danhmuc_id']);
                                    foreach ($categories as $cat_item){
                                        echo $cat_item['ten_danhmuc'];
                                    }
                                ?>
                            </span>
                        </a>						
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path></svg>&nbsp;</span>
                    </li>

                    <li>
                        <strong>
                            <span>
                                <?php echo $product_detail['title']?>
                            </span>
                        </strong>
                    </li>

                </ul>
            </div>
        </div>
        
        <div class="detail_pro_page">
            <div class="container">
                <div class="details_product">
                    <div class="bg_detl_pro">
                        <div class="detl_cont_pro">
                            <div class="detl_img_pro">
                                <div class="sticky">
                                    <div class="product-image-block relative">
                                        <div class="swiper-container gallery-top">
                                            <div class="swiper-wrapper" id="lightgallery">
                                                <?php 
                                                    if(!empty($list_img)){
                                                    foreach($list_img as $item){
                                                ?>
                                                <a class="swiper-slide" data-hash="<?php echo $item['stt']?>" href="" title="Click để xem">
                                                    <img height="370" width="480" src="admin/public/images/<?php echo $item['url_img']?>" alt="Thượng Vy Yến biển - Gừng" class="img-responsive mx-auto d-block swiper-lazy" />
                                                </a>
                                                <?php }}?>
                                            </div>
                                        </div>
                                        
                                        <div class="swiper-container gallery-thumbs ">
                                            <div class="swiper-wrapper">
                                                <?php 
                                                    if(!empty($list_img)){
                                                    foreach($list_img as $item){
                                                ?>
                                                <div class="swiper-slide" data-hash="0">
                                                    <div class="p-100">
                                                        <img height="80" width="80" src="admin/public/images/<?php echo $item['url_img']?>" class="swiper-lazy" />
                                                    </div>	
                                                </div>
                                                <?php }}?>
                                            </div>
                                            <div class="swiper-button-next">    
                                            </div>
                                            <div class="swiper-button-prev">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="detl_info_pro">
                                <h1 class="titl_info_pro">
                                    <?php echo $product_detail['title']?>
                                </h1>
                                <div class="detl_info_pro_top clearfix">
                                    <div class="update_code_info clearfix">
                                        <span class="status_code"> 
                                            Mã:
                                            <span class="desc_sta">Đang cập nhật</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="inventory_quantity">
                                    <span class="mb-break">
                                        <span class="stock-brand-title">Thương hiệu:</span>
                                        <span class="a-vendor">
                                            Sudes Nest
                                        </span>
                                    </span>
                                    <span class="line">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    <span class="mb-break">
                                        <span class="stock-brand-title">Tình trạng:</span>
                                        <span class="a-stock"><span class="a-stock">Còn hàng</span></span>
                                    </span>
                                </div>
                                <form action="" class="form_detl_info">
                                    <div class="desc_info_pro">
                                        <div class="rte">
                                            <?php echo $product_detail['detail']?>
                                        </div>
                                    </div>
                                    <?php if(!empty($product_detail['discount'])){?>
                                    <a class="block-flashsale" href="/san-pham-khuyen-mai" title="Xem ngay">
                                        <div class="heading-flash">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                                                <defs>
                                                    <linearGradient id="prefix__a" x1="50%" x2="50%" y1="36.31%" y2="88.973%">
                                                        <stop offset="0%" stop-color="#FDD835"></stop>
                                                        <stop offset="100%" stop-color="#FFB500"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g fill="none" fill-rule="evenodd">
                                                    <path d="M0 0H16V16H0z"></path>
                                                    <path fill="url(#prefix__a)" stroke="#FF424E" stroke-width="1.1" d="M9.636 6.506S10.34 2.667 7.454 1c-.087 1.334-.786 2.571-1.923 3.401-1.234 1-3.555 3.249-3.53 5.646-.017 2.091 1.253 4.01 3.277 4.953.072-.935.549-1.804 1.324-2.41.656-.466 1.082-1.155 1.182-1.912 1.729.846 2.847 2.469 2.944 4.27v.012c1.909-.807 3.165-2.533 3.251-4.467.205-2.254-1.134-5.316-2.321-6.317-.448.923-1.144 1.725-2.022 2.33z" transform="rotate(4 8 8)"></path>
                                                </g>
                                            </svg>
                                            Hot sale năm mới
                                        </div>
                                        <div class="count-down">
                                            <p class="title-count">
                                                Kết thúc sau:
                                            </p>
                                            <div class="timer-view" data-countdown="countdown" data-date="12-25-2024-09-15-45"><div class="block-timer"><p><b>83</b></p><span>Ngày</span></div><div class="block-timer"><p><b>23</b></p><span>Giờ</span></div><div class="block-timer"><p><b>08</b></p><span>Phút</span></div><div class="block-timer"><p><b>16</b></p><span>Giây</span></div></div>
                                        </div>
                                        <script>
                                            (function($){
                                                "user strict";
                                                $.fn.Dqdt_CountDown = function( options ) {
                                                    return this.each(function() {
                                                        new  $.Dqdt_CountDown( this, options );
                                                    });
                                                }
                                                $.Dqdt_CountDown = function( obj, options ){
                                                    this.options = $.extend({
                                                        autoStart			: true,
                                                        LeadingZero:true,
                                                        DisplayFormat:"<div><span>%%D%%</span> Days</div><div><span>%%H%%</span> Hours</div><div><span>%%M%%</span> Mins</div><div><span>%%S%%</span> Secs</div>",
                                                        FinishMessage:"Háº¿t háº¡n",
                                                        CountActive:true,
                                                        TargetDate:null
                                                    }, options || {} );
                                                    if( this.options.TargetDate == null || this.options.TargetDate == '' ){
                                                        return ;
                                                    }
                                                    this.timer  = null;
                                                    this.element = obj;
                                                    this.CountStepper = -1;
                                                    this.CountStepper = Math.ceil(this.CountStepper);
                                                    this.SetTimeOutPeriod = (Math.abs(this.CountStepper)-1)*1000 + 990;
                                                    var dthen = new Date(this.options.TargetDate);
                                                    var dnow = new Date();
                                                    if( this.CountStepper > 0 ) {
                                                        ddiff = new Date(dnow-dthen);
                                                    }
                                                    else {
                                                        ddiff = new Date(dthen-dnow);
                                                    }
                                                    gsecs = Math.floor(ddiff.valueOf()/1000);
                                                    this.CountBack(gsecs, this);
                                                };
                                                $.Dqdt_CountDown.fn =  $.Dqdt_CountDown.prototype;
                                                $.Dqdt_CountDown.fn.extend =  $.Dqdt_CountDown.extend = $.extend;
                                                $.Dqdt_CountDown.fn.extend({
                                                    calculateDate:function( secs, num1, num2 ){
                                                        var s = ((Math.floor(secs/num1))%num2).toString();
                                                        if ( this.options.LeadingZero && s.length < 2) {
                                                            s = "0" + s;
                                                        }
                                                        return "<b>" + s + "</b>";
                                                    },
                                                    CountBack:function( secs, self ){
                                                        if (secs < 0) {
                                                            self.element.innerHTML = '<div class="lof-labelexpired"> '+self.options.FinishMessage+"</div>";
                                                            $('.block-flashsale').hide();
                                                            return;
                                                        }
                                                        clearInterval(self.timer);
                                                        DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate( secs,86400,100000) );
                                                        DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs,3600,24));
                                                        DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs,60,60));
                                                        DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs,1,60));
                                                        self.element.innerHTML = DisplayStr;
                                                        if (self.options.CountActive) {
                                                            self.timer = null;
                                                            self.timer =  setTimeout( function(){
                                                                self.CountBack((secs+self.CountStepper),self);
                                                            },( self.SetTimeOutPeriod ) );
                                                        }
                                                    }
                                                });
                                                $(document).ready(function(){
                                                    $('[data-countdown="countdown"]').each(function(index, el) {
                                                        var $this = $(this);
                                                        var $date = $this.data('date').split("-");
                                                        $this.Dqdt_CountDown({
                                                            TargetDate:$date[0]+"/"+$date[1]+"/"+$date[2]+" "+$date[3]+":"+$date[4]+":"+$date[5],
                                                            DisplayFormat:"<div class=\"block-timer\"><p>%%D%%</p><span>Ngày</span></div><div class=\"block-timer\"><p>%%H%%</p><span>Giờ</span></div><div class=\"block-timer\"><p>%%M%%</p><span>Phút</span></div><div class=\"block-timer\"><p>%%S%%</p><span>Giây</span></div>",
                                                            FinishMessage: "Chương trình đã hết hạn"
                                                        });
                                                    });
                                                });
                                            })(jQuery);
                                        </script>
                                    </a>
                                    <?php }?>
                                    <div class="box_price_pro clearfix">
                                        <span class="detl_price_pro">
                                            <span class="product_price"><?php echo currency_format($product_detail['price'])?></span>
                                        </span>
                                        <?php if(!empty($product_detail['price_discount'])){?>
                                            <span class="old_price_pro">
                                                <del class="product_price_old"><?php echo currency_format($product_detail['price_discount'])?></del>
                                            </span>
                                        <?php }?>
                                        <?php if(!empty($product_detail['discount'])){?>
                                            <span class="sale-off">-  
                                                <?php echo ($product_detail['discount'])?>% 
                                            </span>
                                        <?php }?>
                                    </div>
                                    <div class="form_gird">
                                        <div class="block-promotion">
                                            <div class="heading-promo">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM190.5 68.78C182.9 55.91 169.1 48 154.2 48H152C129.9 48 112 65.91 112 88C112 110.1 129.9 128 152 128H225.3L190.5 68.78zM360 48H357.8C342.9 48 329.1 55.91 321.5 68.78L286.7 128H360C382.1 128 400 110.1 400 88C400 65.91 382.1 48 360 48V48zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path></svg>
                                                Quà tặng dành cho bạn:
                                            </div>
                                            <div class="promo-content">
                                                <ul>
                                                    <li>Tặng 1 túi giấy xách đi kèm.</li>
                                                    <li>1 Hộp đường phèn</li>
                                                    <li>Tặng bao lì xì Giáp Thìn 2024.</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="boz-form ">
                                            <div class="flex-quantity">
                                                <div class="custom custom-btn-number show">
                                                    <span>Số lượng: </span>
                                                    <div class="input_number_product">									
                                                        <button class="btn_num num_1 button button_qty" type="button">-</button>
                                                        <input type="text" id="qtym" name="quantity" value="1" maxlength="3" class="form-control prd_quantity" >
                                                        <button class="btn_num num_2 button button_qty" type="button"><span>+</span></button>
                                                    </div>
                                                </div>
                                                <div class="btn-mua button_actions clearfix">
                                                        
                                                    <button class="btn-buyNow btn btn-primary">
                                                        <span class="txt-main">Mua ngay</span>
                                                    </button>
                                                    <button type="submit" class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart btn-extent">
                                                        <span class="txt-main">Thêm vào giỏ</span>
                                                    </button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-product">
                                        <ul class="social-media" role="list">
                                            <li class="title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"></path>
                                                </svg>
                                                Chia sẻ
                                            </li>
                                            <li class="social-media__item social-media__item--facebook">
                                                <a title="Chia sẻ lên Facebook" href="https://www.facebook.com/sharer.php?u=https://sudes-nest.mysapo.net" target="_blank" rel="noopener" aria-label="Chia sẻ lên Facebook">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 155.139 155.139" style="enable-background:new 0 0 155.139 155.139;" xml:space="preserve">
                                                        <g>
                                                            <path id="f_1_" style="fill:#010002;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184
                                                                c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452
                                                                v20.341H37.29v27.585h23.814v70.761H89.584z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li class="social-media__item social-media__item--pinterest">
                                                <a title="Chia sẻ lên Pinterest" href="https://pinterest.com/pin/create/button/?url=https://sudes-nest.mysapo.net&amp;" target="_blank" rel="noopener" aria-label="Pinterest">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.977 511.977" style="enable-background:new 0 0 511.977 511.977;" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M262.948,0C122.628,0,48.004,89.92,48.004,187.968c0,45.472,25.408,102.176,66.08,120.16
                                                                    c6.176,2.784,9.536,1.6,10.912-4.128c1.216-4.352,6.56-25.312,9.152-35.2c0.8-3.168,0.384-5.92-2.176-8.896
                                                                    c-13.504-15.616-24.224-44.064-24.224-70.752c0-68.384,54.368-134.784,146.88-134.784c80,0,135.968,51.968,135.968,126.304
                                                                    c0,84-44.448,142.112-102.208,142.112c-31.968,0-55.776-25.088-48.224-56.128c9.12-36.96,27.008-76.704,27.008-103.36
                                                                    c0-23.904-13.504-43.68-41.088-43.68c-32.544,0-58.944,32.224-58.944,75.488c0,27.488,9.728,46.048,9.728,46.048
                                                                    S144.676,371.2,138.692,395.488c-10.112,41.12,1.376,107.712,2.368,113.44c0.608,3.168,4.16,4.16,6.144,1.568
                                                                    c3.168-4.16,42.08-59.68,52.992-99.808c3.968-14.624,20.256-73.92,20.256-73.92c10.72,19.36,41.664,35.584,74.624,35.584
                                                                    c98.048,0,168.896-86.176,168.896-193.12C463.62,76.704,375.876,0,262.948,0z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li class="social-media__item social-media__item--twitter">
                                                <a title="Chia sẻ lên Twitter" href="https://twitter.com/share?url=https://sudes-nest.mysapo.net" target="_blank" rel="noopener" aria-label="Tweet on Twitter">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
                                                                    c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
                                                                    c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
                                                                    c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
                                                                    c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
                                                                    c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
                                                                    C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
                                                                    C480.224,136.96,497.728,118.496,512,97.248z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="line"></div>
                                        <div class="product-wish">
                                            <a href="javascript:void(0)" class="setWishlist btn-views" data-wish="to-yen-tinh-che-cho-be-baby-loai-1" tabindex="0" title="Thêm vào yêu thích">
                                                <img width="25" height="25" src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/heart.png?1717814629369" alt="Thêm vào yêu thích"> 
                                                Thêm vào yêu thích
                                            </a>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="decs_detl_pro_bot">
                        <div class="promotion_sticker">
                            <div class="bg_promo">
                                <div class="titl_promo">
                                    Khuyến mãi dành cho bạn
                                </div>
                                <div class="swiper-container swiper_coupons">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="box_coupons">
                                                <div class="bg_coupons"></div>
                                                <div class="img_coupons">
                                                    <img src="public/images/img_coupon_1.webp" alt="" class="lazyload">
                                                </div>
                                                <div class="content_coupons">
                                                    <a title="Chi tiết" href="javascript:void(0)" class="info-button" data-coupon="NEST200" data-time="12/12/2024" data-content="Áp dụng cho đơn hàng từ <b>4,500,000đ</b> trở lên Không đi kèm với chương trình khác">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                                            <path d="M144 80c0 26.5-21.5 48-48 48s-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="top_content_coupons">
                                                        NEST200
                                                        <span class="line-clamp line-clamp-2">Giảm 200k giá trị đơn hàng</span>
                                                    </div>
                                                    <div class="bot_content_coupons">
                                                        <span>HSD: 12/12/2024</span>
                                                        <div class="code_coupons js-copy" data-copy="NEST200" title="Sao chép">Copy mã</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="box_coupons">
                                                <div class="bg_coupons"></div>
                                                <div class="img_coupons">
                                                    <img src="public/images/img_coupon_1.webp" alt="" class="lazyload">
                                                </div>
                                                <div class="content_coupons">
                                                    <a title="Chi tiết" href="javascript:void(0)" class="info-button" data-coupon="NEST200" data-time="12/12/2024" data-content="Áp dụng cho đơn hàng từ <b>4,500,000đ</b> trở lên Không đi kèm với chương trình khác">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                                            <path d="M144 80c0 26.5-21.5 48-48 48s-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="top_content_coupons">
                                                        NEST100
                                                        <span class="line-clamp line-clamp-2">Giảm 100k giá trị đơn hàng</span>
                                                    </div>
                                                    <div class="bot_content_coupons">
                                                        <span>HSD: 12/12/2024</span>
                                                        <div class="code_coupons js-copy" data-copy="NEST200" title="Sao chép">Copy mã</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="box_coupons">
                                                <div class="bg_coupons"></div>
                                                <div class="img_coupons">
                                                    <img src="public/images/img_coupon_1.webp" alt="" class="lazyload">
                                                </div>
                                                <div class="content_coupons">
                                                    <a title="Chi tiết" href="javascript:void(0)" class="info-button" data-coupon="NEST200" data-time="12/12/2024" data-content="Áp dụng cho đơn hàng từ <b>4,500,000đ</b> trở lên Không đi kèm với chương trình khác">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                                            <path d="M144 80c0 26.5-21.5 48-48 48s-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="top_content_coupons">
                                                        NEST50
                                                        <span class="line-clamp line-clamp-2">Giảm 50k giá trị đơn hàng</span>
                                                    </div>
                                                    <div class="bot_content_coupons">
                                                        <span>HSD: 12/12/2024</span>
                                                        <div class="code_coupons js-copy" data-copy="NEST200" title="Sao chép">Copy mã</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="box_coupons">
                                                <div class="bg_coupons"></div>
                                                <div class="img_coupons">
                                                    <img src="public/images/img_coupon_1.webp" alt="" class="lazyload">
                                                </div>
                                                <div class="content_coupons">
                                                    <a title="Chi tiết" href="javascript:void(0)" class="info-button" data-coupon="NEST200" data-time="12/12/2024" data-content="Áp dụng cho đơn hàng từ <b>4,500,000đ</b> trở lên Không đi kèm với chương trình khác">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                                            <path d="M144 80c0 26.5-21.5 48-48 48s-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="top_content_coupons">
                                                        NESTFREESHIP
                                                        <span class="line-clamp line-clamp-2">Miễn phí giao hàng</span>
                                                    </div>
                                                    <div class="bot_content_coupons">
                                                        <span>HSD: 12/12/2024</span>
                                                        <div class="code_coupons js-copy" data-copy="NEST200" title="Sao chép">Copy mã</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev">
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2.13003" y="29" width="38" height="38" transform="rotate(-45 2.13003 29)" stroke="black" fill="#fff" stroke-width="2"></rect>
                                            <rect x="8" y="29.2133" width="30" height="30" transform="rotate(-45 8 29.2133)" fill="black"></rect>
                                            <path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next">
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2.13003" y="29" width="38" height="38" transform="rotate(-45 2.13003 29)" stroke="black" fill="#fff" stroke-width="2"></rect>
                                            <rect x="8" y="29.2133" width="30" height="30" transform="rotate(-45 8 29.2133)" fill="black"></rect>
                                            <path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cont_detl_pro">
                            <div class="bg_cont_detl_pro">
                                <div class="content_detl">
                                    <div class="l_content_detl">
                                        <div class="product-tab e-tabs not-dqtab">
                                            <ul class="tabs tabs-title clearfix">	
                                                <li class="tab-link active" data-tab="#tab-1">
                                                    <h3>Mô tả sản phẩm</h3>
                                                </li>																	
                                                
                                                <li class="tab-link" data-tab="#tab-2">
                                                    <h3>Hướng dẫn mua hàng</h3>
                                                </li>																	
                                                
                                                <li class="tab-link" data-tab="#tab-3">
                                                    <h3>Đánh giá</h3>
                                                </li>																	
                                            </ul>																									
                                            <div class="tab-float">
                                                <div id="tab-1" class="tab-content content_extab active">
                                                    <div class="rte product_getcontent product-review-content">
                                                        <div class="ba-text-fpt has-height">
                                                            <?php echo $product_detail['description']?>
                                                        </div>
                                                        
                                                        <div class="show-more hidden-lg hidden-md hidden-sm">
                                                            <div class="btn btn-primary btn-default btn--view-more duration-300">
                                                                <span class="more-text">Xem thêm <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                                                                    </svg></span>
                                                                <span class="less-text">Thu gọn <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                                                    <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"></path>
                                                                    </svg></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div id="tab-2" class="tab-content content_extab">
                                                    <div class="rte">
                                                        <p><strong>Bước 1</strong>: Truy cập website và lựa chọn sản phẩm cần mua để mua hàng</p>
                                                        <p><strong>Bước 2</strong>: Click và sản phẩm muốn mua, màn hình hiển thị ra pop up với các lựa chọn sau</p>
                                                        <p>Nếu bạn muốn tiếp tục mua hàng: Bấm vào phần tiếp tục mua hàng để lựa chọn thêm sản phẩm vào giỏ hàng</p>
                                                        <p>Nếu bạn muốn xem giỏ hàng để cập nhật sản phẩm: Bấm vào xem giỏ hàng</p>
                                                        <p>Nếu bạn muốn đặt hàng và thanh toán cho sản phẩm này vui lòng bấm vào: Đặt hàng và thanh toán</p>
                                                        <p><strong>Bước 3</strong>: Lựa chọn thông tin tài khoản thanh toán</p>
                                                        <p>Nếu bạn đã có tài khoản vui lòng nhập thông tin tên đăng nhập là email và mật khẩu vào mục đã có tài khoản trên hệ thống</p>
                                                        <p>Nếu bạn chưa có tài khoản và muốn đăng ký tài khoản vui lòng điền các thông tin cá nhân để tiếp tục đăng ký tài khoản. Khi có tài khoản bạn sẽ dễ dàng theo dõi được đơn hàng của mình</p>
                                                        <p>Nếu bạn muốn mua hàng mà không cần tài khoản vui lòng nhấp chuột vào mục đặt hàng không cần tài khoản</p>
                                                        <p><strong>Bước 4</strong>: Điền các thông tin của bạn để nhận đơn hàng, lựa chọn hình thức thanh toán và vận chuyển cho đơn hàng của mình</p>
                                                        <p><strong>Bước 5</strong>: Xem lại thông tin đặt hàng, điền chú thích và gửi đơn hàng</p>
                                                        <p>Sau khi nhận được đơn hàng bạn gửi chúng tôi sẽ liên hệ bằng cách gọi điện lại để xác nhận lại đơn hàng và địa chỉ của bạn.</p>
                                                        <p>Trân trọng cảm ơn.</p>	
                                                    </div>
                                                </div>	
                                                
                                                <div id="tab-3" class="tab-content content_extab">
                                                    <div class="rte">
                                                        <div class="alert alert-info alert-dismissible margin-top-15 section" role="alert" style="max-width: 100% !important;">
                                                            Bạn tiến hàng mua và cài app <a style="color: red" target="_blank" href="https://apps.sapo.vn/danh-gia-san-pham-v2" title="Đánh giá sản phẩm">Đánh giá sản phẩm</a> mới sử dụng được tính năng này! 
                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>	
                                        </div>
                                    </div>
                                    <div class="r_content_detl">
                                        <div class="sticky_r_cont">
                                            <div class="specifications">
                                                <div class="title">Thông tin chi tiết</div>
                                                <table cellspacing="0" class="cke_show_border">
                                                <tbody>
                                                <tr>
                                                <td><strong>Nhóm</strong></td>
                                                <td>Tổ Yến</td>
                                                </tr>
                                                <tr>
                                                <td><strong>Loại</strong></td>
                                                <td>Yến Tinh Chế</td>
                                                </tr>
                                                <tr>
                                                <td><strong>Khối lượng</strong></td>
                                                <td>100gr (10-11 tổ/hộp)</td>
                                                </tr>
                                                <tr>
                                                <td><b>Bộ sản phẩm</b></td>
                                                <td>
                                                <ul>
                                                <li>100gr Yến&nbsp;</li>
                                                <li>1 Hộp đường phèn</li>
                                                <li>1 Bộ hộp và túi giấy riêng sang trọng</li>
                                                <li>1 Phần quà tặng khuyến mãi tùy chọn (áp dụng khi mua từ 100gr)</li>
                                                </ul>
                                                </td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                <p>&nbsp;</p>
                                            </div>
                                            <div class="section-viewed-product recent-page-viewed">
                                                <h2>
                                                    <span>
                                                        Bạn đã xem
                                                    </span>
                                                </h2>
                                                <div class="product-viewed-content">
                                                    <div class="product-view">
                                                        <a class="image_thumb" href="" title="Tổ Yến Tinh Chế Cho Bé Baby (Loại 1)">
                                                            <img width="370" height="480" class="lazyload loaded" src="public/images/baby-1-1-7810cf8f839c472daf02f0926273c645-master.jpg" alt="Tổ Yến Tinh Chế Cho Bé Baby (Loại 1)" data-was-processed="true">
                                                        </a>
                                                        <div class="product-info">
                                                            <h3 class="product-name"><a href="" title="Tổ Yến Tinh Chế Cho Bé Baby (Loại 1)" class="line-clamp line-clamp-3-new">Tổ Yến Tinh Chế Cho Bé Baby (Loại 1)</a></h3>
                                                            <div class="price-box">
                                                                <span class="price">3.200.000₫</span>
                                                                <span class="compare-price">3.500.000₫</span>

                                                            </div>
                                                            <a class="view-more" href="" title="Xem chi tiết">Xem chi tiết »</a>
                                                        </div>
                                                    </div>

                                                    <div class="product-view">
                                                        <a class="image_thumb" href="" title="Tổ Yến Tinh Chế cho bé BaBy (loại 3)">
                                                            <img width="370" height="480" class="lazyload loaded" src="public/images/to_yen_baby_loai3.webp" alt="Tổ Yến Tinh Chế cho bé BaBy (loại 3)" data-was-processed="true">
                                                        </a>
                                                        <div class="product-info">
                                                            <h3 class="product-name"><a href="" title="Tổ Yến Tinh Chế cho bé BaBy (loại 3)" class="line-clamp line-clamp-3-new">Tổ Yến Tinh Chế cho bé BaBy (loại 3)</a></h3>
                                                            <div class="price-box">
                                                                <span class="price">2.900.000₫</span>
                                                                <span class="compare-price">3.100.000₫</span>
                                                            </div>
                                                            <a class="view-more" href="" title="Xem chi tiết">Xem chi tiết »</a>
                                                        </div>
                                                    </div>

                                                    <div class="product-view">
                                                        <a class="image_thumb" href="" title="Tổ Yến Tinh Chế VIP Loại 2">
                                                            <img width="370" height="480" class="lazyload loaded" src="public/images/tinh-che-2-1-5565c813c66f4c63a00aaf83242ae033-master-1.webp" alt="Tổ Yến Tinh Chế VIP Loại 2" data-was-processed="true">
                                                        </a>
                                                        <div class="product-info">
                                                            <h3 class="product-name"><a href="" title="Tổ Yến Tinh Chế VIP Loại 2" class="line-clamp line-clamp-3-new">Tổ Yến Tinh Chế VIP Loại 2</a></h3>
                                                            <div class="price-box">
                                                                <span class="price">1.900.000₫</span>
                                                                <span class="compare-price">2.100.000₫</span>
                                                            </div>
                                                            <a class="view-more" href="" title="Xem chi tiết">Xem chi tiết »</a>
                                                        </div>
                                                    </div>

                                                    <div class="product-view">
                                                        <a class="image_thumb" href=" title="Thượng Vy Yến biển - Gừng">
                                                            <img width="370" height="480" class="lazyload loaded" src="public/images/thuong_vy_yen_bien_gung.webp" alt="Thượng Vy Yến biển - Gừng" data-was-processed="true">
                                                        </a>
                                                        <div class="product-info">
                                                            <h3 class="product-name"><a href=" title="Thượng Vy Yến biển - Gừng" class="line-clamp line-clamp-3-new">Thượng Vy Yến biển - Gừng</a></h3>
                                                            <div class="price-box">
                                                                57.000₫
                                                            </div>
                                                            <a class="view-more" href=" title="Xem chi tiết">Xem chi tiết »</a>
                                                        </div>
                                                    </div>

                                                    <div class="product-view">
                                                        <a class="image_thumb" href="" title="Tổ yến tinh chế VIP độc quyền">
                                                            <img width="370" height="480" class="lazyload loaded" src="public/images/yen-tc-vip-doc-quyen-50gr-1-a90e36a2d4d14b1ebb345324a21f1c90-bceab20ce4eb46f88cc901b660a4b0b2-master.webp" alt="Tổ yến tinh chế VIP độc quyền" data-was-processed="true">
                                                        </a>
                                                        <div class="product-info">
                                                            <h3 class="product-name"><a href="" title="Tổ yến tinh chế VIP độc quyền" class="line-clamp line-clamp-3-new">Tổ yến tinh chế VIP độc quyền</a></h3>
                                                            <div class="price-box">
                                                                <span class="price">2.500.000₫</span>
                                                                <span class="compare-price">2.700.000₫</span>
                                                            </div>
                                                            <a class="view-more" href="" title="Xem chi tiết">Xem chi tiết »</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="bot_content_detl">
                            <div class="bg_bot_cont_detl">
                                <h2>
                                    <a href="" title="Sản phẩm liên quan">
                                        Sản phẩm liên quan
                                    </a>
                                </h2>
                                <div class="swiper_product_related swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php 
                                            $product_related = get_list_product_by_cat_id($product_detail['danhmuc_id']);
                                            foreach($product_related as $pro_item){
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="item_product_main">
                                                <form action="" method="post" class="form_product_sale duration-300">
                                                    <?php if ($pro_item['discount'] > 0){ ?>
                                                        <span class="flash-sale"> - <?php echo $pro_item['discount']?>% </span>
                                                    <?php } ?>
                                                    <div class="tag-promo" title="Quà tặng">
                                                        <img src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/tag_pro_icon.svg?1717814629369" data-src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/tag_pro_icon.svg?1717814629369" alt="Quà tặng" class="lazyload loaded">
                                                        <div class="promotion-content">
                                                            <div class="line-clamp-5-new" title="- Tặng 1 túi giấy xách đi kèm - 1 Hộp đường phèn ">
                                                            <p>
                                                            <span style="letter-spacing: -0.2px;">- Tặng 1 túi giấy xách đi kèm <br>- 1 Hộp đường phèn </span>
                                                            </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-thumbnail">
                                                        <a class="image_thumb scale_hover" href="" title="Tổ Yến Tinh Chế cho bé BaBy (loại 3)">
                                                            <img class="lazyload duration-300" src="admin/public/images/<?php echo $pro_item['img']?>"  data-src="//bizweb.dktcdn.net/thumb/large/100/506/650/products/set-qua-20-10-maneli-1.jpg?v=1708655273420" alt="Tổ Yến Tinh Chế cho bé BaBy (loại 3)">
                                                        </a>
                                                    </div>  
                                                    <div class="product-info">
                                                        <div class="name-price">
                                                            <h3 class="product-name line-clamp-2-new">
                                                                <a href="" title="Tổ Yến Tinh Chế cho bé BaBy (loại 3)"><?php echo $pro_item['title']?></a>
                                                            </h3>
                                                            <div class="product-price-cart">
                                                                <?php if ($pro_item['price_discount'] > 0){ ?>
                                                                    <span class="compare-price"><?php echo currency_format($pro_item['price_discount'])?></span>
                                                                <?php } ?>
                                                                <span class="price"><?php echo currency_format($pro_item['price'])?></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-button">
                                                            <input type="hidden" name="variantId" value="110202248" />
                                                            <button class="btn-cart btn-views add_to_cart btn btn-primary " title="Thêm vào giỏ hàng">
                                                                <span>Thêm vào giỏ</span>
                                                                <svg enable-background="new 0 0 32 32" height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"/></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"/></g></g></svg>
                                                            </button>
                                                            <a href="javascript:void(0)" class="setWishlist btn-views btn-circle" data-wish="set-qua-2010-maneli-1-boi-bo-suc-khoe-duong-nhan" tabindex="0" title="Thêm vào yêu thích">
                                                                <img width="25" height="25" src="//bizweb.dktcdn.net/100/506/650/themes/944598/assets/heart.png?1717814629369" alt="Thêm vào yêu thích"/> 
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="swiper-button-next">
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2.13003" y="29" width="38" height="38" transform="rotate(-45 2.13003 29)" stroke="black" fill="#fff" stroke-width="2"></rect>
                                            <rect x="8" y="29.2133" width="30" height="30" transform="rotate(-45 8 29.2133)" fill="black"></rect>
                                            <path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-prev">
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2.13003" y="29" width="38" height="38" transform="rotate(-45 2.13003 29)" stroke="black" fill="#fff" stroke-width="2"></rect>
                                            <rect x="8" y="29.2133" width="30" height="30" transform="rotate(-45 8 29.2133)" fill="black"></rect>
                                            <path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
get_footer();
?>