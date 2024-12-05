<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}
function get_product_cat(){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `trangthai`='Công khai'");
    return $result;
}

function get_total_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}
function get_list_img_by_id($product_id){
    $item=db_fetch_array("SELECT * FROM `tbl_images` WHERE (`id_cha` = {$product_id} AND `loai_img`=1) ORDER BY `stt` ASC");
    return $item;
}



