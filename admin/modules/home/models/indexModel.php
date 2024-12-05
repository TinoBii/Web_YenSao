<?php
function get_list_order(){
    $item=db_fetch_array("SELECT * FROM `tbl_dondathang`");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}

function get_order_by_id($id_ddh){
    $item=db_fetch_row("SELECT * FROM `tbl_dondathang`,`tbl_khachhang` WHERE `tbl_dondathang`.`id_kh`=`tbl_khachhang`.`id_kh` AND `id_ddh`='{$id_ddh}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_list_order_th($trangthai){

    if($trangthai==1){
        $result = db_fetch_array("SELECT * FROM `tbl_dondathang` WHERE `trangthai` ='Đang xử lý'");    }
    else if($trangthai==2){
        $result = db_fetch_array("SELECT * FROM `tbl_dondathang` WHERE `trangthai` ='Đang vận chuyển'");    }
    else if($trangthai==3){
        $result = db_fetch_array("SELECT * FROM `tbl_dondathang` WHERE `trangthai` ='Thành công'");    }
    else if($trangthai==4){
        $result = db_fetch_array("SELECT * FROM `tbl_dondathang` WHERE `trangthai` ='Hủy đơn'");    }
    else {
        $result = db_fetch_array("SELECT * FROM `tbl_dondathang`");    }
    return $result;
}
?>