<?php
	if($_GET['giatri2']==true){header("location: $host_link_full");}
	else{$tenmien=$pages;}
	
	$show_datas=lap('sanpham',"tenmien='{$tenmien}'",' ',' ',$langx);
	$row_show_datas=mysql_fetch_assoc_fix($show_datas);
	$id=$row_show_datas['id'];$id=php_settype($id);
	$GET_idbl=$id;
	$mang_data=unserialize(MyDe($row_show_datas['mang']));
	
	chinh("sanpham","id='{$id}'","xem=xem+1"," "," ");
	
	if($row_show_datas['cap1']==0){$cap1=-1;}else{$cap1=$row_show_datas['cap1'];}
	if($row_show_datas['cap2']==0){$cap2=-1;}else{$cap2=$row_show_datas['cap2'];}
	if($row_show_datas['cap3']==0){$cap3=-1;}else{$cap3=$row_show_datas['cap3'];}
	if($row_show_datas['cap4']==0){$cap4=-1;}else{$cap4=$row_show_datas['cap4'];}
	
	if($row_show_datas['cap4']==true){$iddanhmuc=$row_show_datas['cap4'];}
	elseif($row_show_datas['cap3']==true){$iddanhmuc=$row_show_datas['cap3'];}
	elseif($row_show_datas['cap2']==true){$iddanhmuc=$row_show_datas['cap2'];}
	elseif($row_show_datas['cap1']==true){$iddanhmuc=$row_show_datas['cap1'];}
?>	
<section id="container">
    <ul class="ul_breacrum" itemscope itemtype="http://schema.org/BreadcrumbList" style="display:none;">   
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo $host_link_full; ?>">
                <span itemprop="name"><?php echo _TRANG_CHU_; ?></span>
            </a>
            <?php $dem_beck=1; ?>
            <meta itemprop="position" content="<?php echo $dem_beck; ?>">
        </li>
        <?php if($cap1!=-1){$dem_beck=$dem_beck+1; ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo ten('danhmuc',"id='{$cap1}'","tenmien"); ?>.htm">
                <span itemprop="name"><?php echo ten('danhmuc',"id='{$cap1}'","ten"); ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $dem_beck; ?>">
        </li>
        <?php }?>
        <?php if($cap2!=-1){$dem_beck=$dem_beck+1; ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo ten('danhmuc',"id='{$cap2}'","tenmien"); ?>.htm">
                <span itemprop="name"><?php echo ten('danhmuc',"id='{$cap2}'","ten"); ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $dem_beck; ?>">
        </li>
        <?php }?>
        <?php if($cap3!=-1){$dem_beck=$dem_beck+1; ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo ten('danhmuc',"id='{$cap3}'","tenmien"); ?>.htm">
                <span itemprop="name"><?php echo ten('danhmuc',"id='{$cap3}'","ten"); ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $dem_beck; ?>">
        </li>
        <?php }?>
        <?php if($cap4!=-1){$dem_beck=$dem_beck+1; ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo ten('danhmuc',"id='{$cap4}'","tenmien"); ?>.htm">
                <span itemprop="name"><?php echo ten('danhmuc',"id='{$cap4}'","ten"); ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $dem_beck; ?>">
        </li>
        <?php }?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo $row_show_datas['tenmien']; ?>.htm">
                <span itemprop="name"><?php echo $row_show_datas['ten']; ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $dem_beck+1; ?>">
        </li>
    </ul>
    <section class="bg_cont">
        <h1 class="til_bg_cont">
            <strong><?php echo ten('danhmuc',"id='{$iddanhmuc}'","ten"); ?></strong>
        </h1>
    </section><!-- End .bg_cont -->
    
    <section class="f_tb">
        <ul class="list_tb">
            <li>
                <div class="min_wrap">
                    <div class="l_list_tb">
                        <h2 class="til_h_1"><?php echo $row_show_datas['ten']; ?></h2>
                        <div class="f-detail clearfix">
                            <?php echo $row_show_datas['tomtat']; ?>
                        </div>
                    </div><!-- End .l_list_tb -->
                    <div class="r_list_tb">
                        <img src="<?php echo $row_show_datas['hinh2']; ?>" alt="<?php echo $row_show_datas['tenkodau']; ?>">
                    </div><!-- End .r_list_tb -->
                </div><!-- End .min_wrap -->
            </li>
        </ul><!-- End .list_tb -->
    </section><!-- End .f_tb -->
	
	<style>
		.t_ct_prod_D {
			padding-bottom: 13px;
			margin-top: 10px;
		}
		.t_ct_prod_D h2 {
			float: left;
			color: #333;
			font-size: 16px;
			padding: 0 15px;
			line-height: 38px;
			background: #fff;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			cursor: pointer;
		}
		.t_ct_prod_D h2.active {
			color: #fff;
			background: #1468b2;
		}
		.t_ct_prod_D h2 i {
			font-size: 20px;
			margin-right: 5px;
			position: relative;
			top: 1px;
		}
	</style>
	
	<section class="f_page">
        <div class="min_wrap">
			<div class="ct_prod_D_l">
				<div class="min_wrap t_ct_prod_D clearfix">
					<h2 class="tab_prod_D1" id_tab="1">
						<i class="fas fa-info-circle" aria-hidden="true"></i>
						Thông số kỹ thuật
					</h2>
					<h2 class="tab_prod_D2" id_tab="2">
						<i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
						Hướng dẫn sử dụng
					</h2>
					<h2 class="tab_prod_D3" id_tab="3">
						<i class="fas fa-user-cog" aria-hidden="true"></i>
						Hướng dẫn lắp đặt
					</h2>
				</div><!-- End .t_ct_prod_D -->
				<div class="load_prod_D"></div>
				<script>
					$(document).ready(function(){
						$(".tab_prod_D1").addClass("active");
						$(".load_prod_D").load("librarys/sanpham-chitiet-1.php?id=<?php echo $row_show_datas['id']; ?>");						

						$(".t_ct_prod_D h2").click(function(){
							var id_tab=$(this).attr("id_tab");
							$(".load_prod_D").load("librarys/sanpham-chitiet-"+id_tab+".php?id=<?php echo $row_show_datas['id']; ?>");
							$(".t_ct_prod_D h2").removeClass("active");
							$(".tab_prod_D"+id_tab).addClass("active");
						});
					});
				</script>
			</div><!-- End .ct_prod_D_l -->
		</div><!-- End .min_wrap -->
    </section><!-- End .f_page -->
    <?php include_once("librarys/bot_lienhe.php");?>
</section><!-- End #container -->