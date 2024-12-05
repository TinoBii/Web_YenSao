<?php
function get_total_banner_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='1'");
    return count($result);
}
function get_total_banner(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0'");
    return count($result);
}
function get_total_banner_congkhai(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_banner`.`trangthai`='Công khai'");   
    return count($result);
}
function get_total_banner_chuaduyet(){
    $result = db_fetch_array("SELECT * FROM `tbl_banner` ,`tbl_users` WHERE `tbl_banner`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_banner`.`trangthai`='Chờ duyệt'");   
    return count($result);
}
