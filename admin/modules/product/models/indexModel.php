<?php

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_user` WHERE `user_id` = {$id}");
    return $item;
}

function get_list_cat_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` ,`tbl_users` WHERE `tbl_danhmuc`.`user_id`=`tbl_users`.`user_id`");
    return $result;
}

function add_product($data){
    return db_insert('tbl_product',$data);
}
function get_list_product1($start=1,$num_per_page=10,$where=""){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0' LIMIT {$start},{$num_per_page}");
    return $result;
}
function get_list_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product`,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0'");
    return $result;
}
function get_list_product_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='1'");
    return $result;
}
function check_product_id($product_id){
    $check_id=db_num_rows("SELECT * FROM `tbl_product` WHERE `product_id`='{$product_id}'");
    if($check_id>0){
        return false;
    }
    return true;
}
function get_user_id_by_username($username){
    $item=db_fetch_row("SELECT * FROM `tbl_users` WHERE `username`='{$username}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
    
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

function get_cat_by_id($cat_id){
    $item=db_fetch_row("SELECT * FROM `tbl_loaiproduct` WHERE `cat_id` = {$cat_id}");
    if(empty($item)){
        echo "Không tồn tại";
    }
    return $item;
}

function get_level_by_cat($level){
    $level_cat=db_fetch_row("SELECT * FROM `tbl_loaiproduct` WHERE `cat_id`={$level}");
    if($level_cat>0){
        $level_cat=$level_cat['level']+1;
        return $level_cat;
    }
    else{
        $level_cat=0;
        return $level_cat;
    }
}

// function get_list_product_th($trangthai)
// {
//     if($trangthai==1){
//         $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct`,`tbl_users` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0' && `tbl_product`.`trangthai`='Công khai'");    }
//     else{
//         $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct`,`tbl_users` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0' && `tbl_product`.`trangthai`='Chờ duyệt'");    }
//     return $result;
// }

function get_list_img_by_id($product_id){
    $item=db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_cha` = {$product_id} AND `loai_img`=1");
    return $item;
}

function get_cap_by_parent_id($danhmuc_id_cha) {
    $item=db_fetch_array("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id_cha` = {$danhmuc_id_cha}");
    return $item;
}
function get_ten_dm_by_id($danhmuc_id) {
    $item=db_fetch_row("SELECT `ten_danhmuc` FROM `tbl_danhmuc` WHERE `danhmuc_id` = {$danhmuc_id}");
    return $item;
}

