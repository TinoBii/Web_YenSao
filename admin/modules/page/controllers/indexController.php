<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','page');
    load('lib','pagging');
}

function indexAction() {
    load_view('index');
}
function add_pageAction(){
    global $error,$time,$page_title,$page_detail,$trangthai,$user_id;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['page_title'])){
            $error['page_title']="Không được để trống Tiêu đề";
        }
        else{
            $page_title=$_POST['page_title'];
        }
        if(empty($_POST['page_detail'])){
            $error['page_detail']="Không được để trống Nội dung trang";
        }
        else{
            $page_detail=$_POST['page_detail'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống Trạng Thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        $user=get_user_id_by_username(user_login());
        $user_id=$user['user_id'];
        $time=date('d/m/Y - H:i:s');
        $data=array(
            'page_title'=>$page_title,
            'page_detail'=>$page_detail,
            'trangthai'=>$trangthai,
            'user_id'=>$user_id,
            'time'=>$time
        );
        db_insert('tbl_page',$data);
        redirect("?mod=page&action=list_page");
    }
    load_view('add_page');
}
function list_pageAction(){
    // $list_page=get_list_page();
    // $data['list_page']=$list_page;
    $num_row=db_num_rows("SELECT * FROM `tbl_banner`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_page=get_list_page($start,$num_per_page);
    $data['list_page']=$list_page;
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
    load_view('list_page',$data);
}
function edit_pageAction(){
    global $error,$page_id,$time,$page_title,$page_detail,$trangthai,$user_id;
    $page_id=(int) $_GET['page_id'];
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['page_title'])){
            $error['page_title']="Không được để trống Tiêu đề";
        }
        else{
            $page_title=$_POST['page_title'];
        }
        if(empty($_POST['page_detail'])){
            $error['page_detail']="Không được để trống Nội dung trang";
        }
        else{
            $page_detail=$_POST['page_detail'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống Trạng Thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        $user=get_user_id_by_username(user_login());
        $user_id=$user['user_id'];
        $time=date('d/m/Y - H:i:s');
        $data=array(
            'page_title'=>$page_title,
            'page_detail'=>$page_detail,
            'trangthai'=>$trangthai,
            'user_id'=>$user_id,
            'time'=>$time
        );
        db_update('tbl_page',$data,"`page_id`='{$page_id}'");
        redirect("?mod=page&action=list_page");
    }
   
    $edit_page=get_page_by_id($page_id);
    $data['edit_page']=$edit_page;
    load_view('edit_page',$data);
}
function delete_pageAction(){
    $id=(int)$_GET['page_id'];
    if(isset($_POST['btn-delete'])){
        db_delete('tbl_page',"`page_id`={$id}");
        redirect("?mod=page&action=list_page");
    }

    $delete_page=get_page_by_id($id);
    $data['delete_page']=$delete_page;
    load_view('delete_page',$data);
}
function list_page_garbageAction(){
    
    $list_page=get_list_page_garbage();
    $data['list_page']=$list_page;
    load_view('list_page',$data);
}
function list_page_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_page=get_list_page_th($trangthai);
    $data['list_page']=$list_page;
    load_view('list_page',$data);
}
function trash_canAction(){
    global $page_id;
    $page_id=(int)$_GET['page_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_page',$data,"`page_id`={$page_id}");
    echo '<script>alert("Đã đưa vào thùng rác!")</script>';
    redirect("?mod=page&action=list_page");
}
function restore_pageAction(){
    global $page_id;
    $page_id=(int)$_GET['page_id'];
    $data=array(
        'thungrac'=>0
    );
    db_update('tbl_page',$data,"`page_id`={$page_id}");
    echo '<script>alert("Đã đưa vào thùng rác!")</script>';
    redirect("?mod=page&action=list_page");
}
?>

