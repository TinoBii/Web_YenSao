<?php
function construct(){
    load_model('index');
    load('lib','validation');
    load('lib','order');
    load('lib','pagging');
}
function indexAction(){
    $num_row=db_num_rows("SELECT * FROM `tbl_dondathang`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_order=get_list_order($start,$num_per_page);
    $data['list_order']=$list_order;
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
    load_view("index",$data);
    // $list_order=get_list_order();
    // $data['list_order']=$list_order;
    // load_view("index",$data);
}
function detail_ctddhAction(){
    $id_ddh=(int)$_GET['id_ddh'];
    if(isset($_POST['btn-trangthai'])){
        $data=[
            'trangthai'=>$_POST['trangthai']
        ];
        db_update('tbl_dondathang',$data,"`id_ddh`='{$id_ddh}'");
        $_SESSION['result']="Cập nhật trạng thái đơn hàng thành công!";
    }
    $ddh=get_order_by_id($id_ddh);
    $data['ddh']=$ddh;
    $_SESSION['successMsg']=$_SESSION['result'];
    unset($_SESSION['result']);
    $_SESSION['result']="";
    load_view("detail_ctddh",$data);
}
function list_orderAction(){
    $num_row=db_num_rows("SELECT * FROM `tbl_dondathang`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_order=get_list_order($start,$num_per_page);
    $data['list_order']=$list_order;
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
    load_view("list_order",$data);
}
function list_order_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_order=get_list_order_th($trangthai);
    $data['list_order']=$list_order;
    load_view("list_order",$data);
}
function updateAction(){
    $id=$_POST['id'];
    echo $id;
}
function delete_orderAction(){
    $id_ddh=(int)$_GET['id_ddh'];
    // $id_kh=get_order_by_id($id_ddh);
   if(isset($_POST['btn-delete'])){
        db_delete('tbl_ctdondathang',"`id_ddh`={$id_ddh}");
        // db_delete('tbl_khachhang',"`id_kh`={$id_kh['id_kh']}");
        db_delete('tbl_dondathang',"`id_ddh`={$id_ddh}");
        redirect("?mod=order&action=Index");
   }
   $ddh=get_order_by_id($id_ddh);
   $data['ddh']=$ddh;
   $_SESSION['successMsg']=$_SESSION['result'];
   unset($_SESSION['result']);
   $_SESSION['result']="";
   load_view("delete_order",$data);
}
?>