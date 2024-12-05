<?php
// function get_list_users() {
//     $result = db_fetch_array("SELECT * FROM `tbl_user`");
//     return $result;
// }
// function get_list_product_tuongtu($cat_id,$product_id){
//     // $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct` WHERE  `cat_id`='{$cat_id}' AND `product_id`!='{$product_id}'");
//     $result = db_fetch_array("SELECT * FROM `tbl_product` ,`tbl_loaiproduct` WHERE (`tbl_product`.`cat_id`=`tbl_loaiproduct`.`cat_id`) AND `cat_id`='{$cat_id}' AND `product_id`!='{$product_id}'");

//     return $result;
// }
function get_product_by_string($string){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE title LIKE '%{$string}%'");
    return $result;
}

function get_list_pro_by_cat_id($id, $limit = 4){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `danhmuc_id`='{$id}' LIMIT {$limit}");
    return $result;
}

?>

