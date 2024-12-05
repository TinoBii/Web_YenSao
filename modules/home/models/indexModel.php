<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_user`");
    return $result;
}
function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_user` WHERE `user_id` = {$id}");
    return $item;
}
function get_list_cat_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_loaiproduct` ,`tbl_users` WHERE `tbl_loaiproduct`.`user_id`=`tbl_users`.`user_id`");
    return $result;
}
// function get_list_product(){
//     $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id`) AND `thungrac`='0' LIMIT 5");
//     return $result;
// }
function get_list_product_banchay(){
    $result = db_fetch_array("SELECT * FROM `tbl_product`  WHERE `trangthai`='Công khai' AND `thungrac`='0' LIMIT 5");
    return $result;
}   
function get_list_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product`  WHERE `trangthai`='Công khai' AND `thungrac`='0' LIMIT 8");
    return $result;
}
function get_product_by_id($product_id){
    $result=db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`='{$product_id}'");
    if(!empty($result)){
        
        return $result;
    }
    else{
        echo "không tồn tại";
    }
    
}
function get_list_product_noibat(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id` && `noibat`='1') AND `thungrac`='0'");
    return $result;
}
function get_list_page(){
    $result = db_fetch_array("SELECT * FROM `tbl_page`");
    return $result;
}
function get_list_slide(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide`");
    return $result;
}
function get_list_banner_trai(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` WHERE `trangthai` = 'Công khai' AND `thungrac`='0' AND `loai_banner`='Banner trái'");
    return $result;
}
function get_list_banner_tren(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` WHERE `trangthai` = 'Công khai' AND `thungrac`='0' AND `loai_banner`='Banner trên' LIMIT 2");
    return $result;
}
function get_list_post(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `trangthai` = 'Công khai'");
    return $result;
}
function get_post_by_id($post_id){
    $result=db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='{$post_id}'");
    if(!empty($result)){
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}
function get_cat_by_id_cha($danhmuc_id_cha){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id_cha` = '{$danhmuc_id_cha}'");
    return $result;
}
function get_list_product_sale(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `noibat` = 2 AND `price_discount` != 0 AND `trangthai`='Công khai' AND `thungrac`='0'");
    return $result;
}
function get_list_contact(){
    $result = db_fetch_array("SELECT * FROM `tbl_lienhe`");
    return $result;
}

function get_list_categories(){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `trangthai`= 'Công khai'");
    return $result;
}

function get_list_categories_by_catid_cha($danhmuc_id_cha){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `trangthai`= 'Công khai' AND `danhmuc_id_cha` = '{$danhmuc_id_cha}'");
    return $result;
}

function get_categories_by_id($danhmuc_id){
    $result = db_fetch_row("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id`= '{$danhmuc_id}'");
    return $result;
}


