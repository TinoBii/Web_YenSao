<?php
function get_list_order($start=1,$num_per_page=10,$where=""){
    $item=db_fetch_array("SELECT * FROM `tbl_dondathang` LIMIT {$start},{$num_per_page}");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
// function get_list_order1(){
//     $item=db_fetch_array("SELECT * FROM `tbl_dondathang`,`tbl_khachhang` WHERE `tbl_dondathang`.`id_kh`=`tbl_khachhang`.`id_kh` GROUP BY `tbl_dondathang`.`id_kh`");
//     if(!empty($item)){
//         return $item;
//     }
//     else{
//         echo "không tồn tại";
//     }
// }
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
function get_total_by_month($thang){
    $result=db_fetch_array("SELECT * FROM `tbl_ctdondathang`,`tbl_dondathang` WHERE (`tbl_dondathang`.`id_ddh`=`tbl_ctdondathang`.`id_ddh`) AND MONTH(`NgayDat`)=$thang ");
    $tong=0;
    if(!empty($result)){
         foreach($result as $item){
            $tong+=$item['DonGia'];
        }
    } 
    return $tong;
}

function get_doanhthu_thang($thang){
    $doanhthunam=get_total();
    $doanhthuthang=get_total_by_month($thang);
    if($doanhthuthang!=null && $doanhthunam!=null){
        $doanhthu=($doanhthuthang/$doanhthunam)*100;
        return round($doanhthu);
    }
    return 0;
}
?>