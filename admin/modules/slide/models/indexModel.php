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
function get_list_slide($start=1,$num_per_page=10,$where=""){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0'  LIMIT {$start},{$num_per_page}");
    return $result;
}
function get_list_slide_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='1'");
    return $result;
}
function get_slide_by_id($slide_id){
    $item=db_fetch_row("SELECT * FROM `tbl_slide` WHERE `slide_id`='{$slide_id}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_list_slide_th($trangthai){
    if($trangthai==1){
        
        $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_slide`.`trangthai`='Công khai'");   }
    else{
        $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_slide`.`trangthai`='Chờ duyệt'");   }
    return $result;
}

