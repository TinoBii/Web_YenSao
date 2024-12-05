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

function get_list_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0'");
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
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id` ) AND `thungrac`='0' LIMIT 3");
    return $result;
}
function get_list_page(){
    $result = db_fetch_array("SELECT * FROM `tbl_page`");
    return $result;
}

function get_list_product_by_cat_id($danhmuc_id){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `danhmuc_id`='{$danhmuc_id}'");
    return $result;
}

function get_cat_by_id($danhmuc_id){
    $result=db_fetch_row("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id`='{$danhmuc_id}'");
    if(!empty($result)){
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}
function get_total_product_by_cat($cat_id){
    $result=db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`={$cat_id}");
    return count($result);
}

function get_list_categories(){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `trangthai`= 'Công khai'");
    return $result;
}

function get_list_categories_by_catid_cha($danhmuc_id_cha){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `trangthai`= 'Công khai' AND `danhmuc_id_cha` = '{$danhmuc_id_cha}'");
    return $result;
}

function get_cat_by_product($danhmuc_id){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id`= {$danhmuc_id}");
    return $result;
}

