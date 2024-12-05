<?php
function get_kh_by_order($kh_id){
    $item=db_fetch_row("SELECT * FROM `tbl_khachhang` WHERE id_kh='{$kh_id}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_sl_by_order($id_ddh){
    $ddh=db_fetch_array("SELECT * FROM `tbl_ctdondathang` WHERE id_ddh='{$id_ddh}'");
   
    if(!empty($ddh)){
        $tong=0;
        $soluong=0;
        foreach($ddh as $item){
            $tong+=$item['DonGia'];
            $soluong+=$item['soluong'];

        }
        $data=[
            'tong'=>$tong,
            'soluong'=>$soluong
        ];
        return $data;
    }
    else{
        echo "không tồn tại";
    }
}
function get_ctddh_by_order($id_ddh){
    $ddh=db_fetch_array("SELECT * FROM `tbl_ctdondathang` WHERE id_ddh='{$id_ddh}'");
   
    if(!empty($ddh)){
       
        return $ddh;
    }
    else{
        echo "không tồn tại";
    }
}
function get_sp_by_id_ctddh($id_product){
    $result=db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`='{$id_product}'");
    if(!empty($result)){
       
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}
function get_total_order_by_tt($trangthai){
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
    if(!empty($result)){
        return count($result);
        }
        return 0;
}
function get_total(){
    $ddh=db_fetch_array("SELECT * FROM `tbl_ctdondathang`,`tbl_dondathang` WHERE `tbl_ctdondathang`.`id_ddh`=`tbl_dondathang`.`id_ddh` AND `tbl_dondathang`.`trangthai`='Thành công'");
    
    if(!empty($ddh)){
        $tong=0;      
        foreach($ddh as $item){
            $tong+=$item['DonGia'];
        }       
        return $tong;
    }
    
}
// function get_total_by_month($month){
//     $ddh=db_fetch_array("SELECT * FROM `tbl_ctdondathang`,`tbl_dondathang` WHERE `tbl_ctdondathang`.`id_ddh`=`tbl_dondathang`.`id_ddh` AND `tbl_dondathang`.`trangthai`='Thành công' AND MONTH(`tbl_ctdondathang`.`NgayDat`)=$month) ");
//     if(!empty($ddh)){
//         $tong=0;      
//         foreach($ddh as $item){
//             $tong+=$item['DonGia'];
//         }       
//         return $tong;
//     }
// }
?>