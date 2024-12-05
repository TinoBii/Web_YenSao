<?php
function get_total_post_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `thungrac`='1'");
    if(!empty($result)){
    return count($result);
    }
    return 0;
}
function get_total_post(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `thungrac`='0'");
    if(!empty($result)){
        return count($result);
        }
        return 0;
}
function get_total_post_congkhai(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `trangthai`='Công khai'");
    if(!empty($result)){
        return count($result);
        }
        return 0;
}
function get_total_post_chuaduyet(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `trangthai`='Chưa duyệt'");
    if(!empty($result)){
        return count($result);
        }
        return 0;
}
?>