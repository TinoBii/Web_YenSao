<?php
function get_total_slide_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='1'");
    return count($result);
}
function get_total_slide(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0'");
    return count($result);
}
function get_total_slide_congkhai(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_slide`.`trangthai`='Công khai'");   
    return count($result);
}
function get_total_slide_chuaduyet(){
    $result = db_fetch_array("SELECT * FROM `tbl_slide` ,`tbl_users` WHERE `tbl_slide`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_slide`.`trangthai`='Chờ duyệt'");   
    return count($result);
}
