<?php
function get_user_id_by_username($username){
    $item=db_fetch_row("SELECT * FROM `tbl_users` WHERE `username`='{$username}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
    
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_user` WHERE `user_id` = {$id}");
    return $item;
}
function get_list_banner($start=1,$num_per_page=10,$where=""){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' LIMIT {$start},{$num_per_page}");
    return $result;
}
function get_list_banner_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='1'");
    return $result;
}
function get_banner_by_id($banner_id){
    $item=db_fetch_row("SELECT * FROM `tbl_banner` WHERE `banner_id`='{$banner_id}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_list_banner_th($trangthai){
    if($trangthai==1){
        
        $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_banner`.`trangthai`='Công khai'");   }
    else{
        $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_banner`.`trangthai`='Chờ duyệt'");   }
    return $result;
}

