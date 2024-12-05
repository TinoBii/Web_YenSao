<?php
function get_total_page_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_page` ,`tbl_users` WHERE `tbl_page`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='1'");
    return count($result);
}
function get_total_page(){
    $result = db_fetch_array("SELECT * FROM `tbl_page` ,`tbl_users` WHERE `tbl_page`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0'");
    return count($result);
}
function get_total_page_congkhai(){
    $result = db_fetch_array("SELECT * FROM `tbl_page` ,`tbl_users` WHERE `tbl_page`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_page`.`trangthai`='Công khai'");   
    return count($result);
}
function get_total_page_chuaduyet(){
    $result = db_fetch_array("SELECT * FROM `tbl_page` ,`tbl_users` WHERE `tbl_page`.`user_id`=`tbl_users`.`user_id` AND `thungrac`='0' AND `tbl_page`.`trangthai`='Chờ duyệt'");   
    return count($result);
}
