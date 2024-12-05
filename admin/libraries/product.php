<?php
function get_total_product_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='1'");
    return count($result);
}
function get_total_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0'");
    return count($result);
}
function get_total_product_congkhai(){
    $result = db_fetch_array("SELECT * FROM  `tbl_product` ,`tbl_danhmuc`,`tbl_users` WHERE (`tbl_product`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_product`.`user_id`=`tbl_users`.`user_id`) AND `thungrac`='0' AND `tbl_product`.`trangthai`='Công khai'");   
    return count($result);
}
function get_total_product_chuaduyet(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `thungrac`='0' AND `trangthai`='Chờ duyệt'");
    return count($result);
}

