<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','slide');
    load('lib','pagging');
}

function add_slideAction(){
    global $error,$time,$slide_title,$mota,$trangthai,$user_id,$url,$img, $img_name;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['slide_title'])){
            $error['slide_title']="Không được để trống Tiêu đề";
        }
        else{
            $slide_title=$_POST['slide_title'];       
        }
        if(empty($_POST['mota'])){
            $error['mota']="Không được để trống Mô tả ";
        }
        else{
            $mota=$_POST['mota'];       
        }
        
        if(empty($_POST['trangthai'])){
        $error['trangthai']="Không được để trống trạng thái";
        }
        else{
        $trangthai=$_POST['trangthai'];
        }
        $url=$_POST['url'];
        if(isset($_FILES['file'])){

            $upload_dir='public/images/';
            // Đường dẫn của file sau khi upload
            $upload_file=$upload_dir.$_FILES['file']['name'];
            // xử lý upload đúng file ảnh
            $type_allow=array('jpg','png','gift','jpeg');
            // thư mục chứa file uploads
            $file_name=pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            // lấy đuôi file
            // echo $type;
            if(!in_array(strtolower($type),$type_allow)){
                $error['type']='chỉ được upload file có đuôi jpg,png,gift,jpeg';
            }
            else{
                # upload file có kích thước cho phép(20mb~ 29000000)
                $file_size=$_FILES['file']['size'];
                if($file_size>29000000){
                    $error['file_size']='chỉ được upload file bé hơn 20MB';
                }
                # kiểm tra trùng file trên hệ thống 
                if(file_exists($upload_file)){
                    # kiểm tra trùng file trên hệ thống
                    //===================
                    // Xử lý tên file tự động
                    //===================
                    #Tạo file mới
                    // tên file.duoi file
                    $file_name=pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);
                    $new_file_name=$file_name.'-copy.';
                    $new_upload_file=$upload_dir.$new_file_name.$type;
                    $k=1;
                    while(file_exists($new_upload_file)){
                        $new_file_name=$file_name."-copy({$k}).";
                        $k++;
                        $new_upload_file=$upload_dir.$new_file_name.$type;
                    }
                    $upload_file=$new_upload_file;
                    $img_name=$new_file_name.$type;
                   
                }
                $img_name=$file_name.'.'.$type;
                
            }
        }
        
        if(empty($error)){
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $name_img=create_slug($slide_title).'-'.date('Y-m-d').''.rand(10,100000);
            resize_img($_FILES['file']['tmp_name'],$type,$name_img,760,380);   
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");

            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $img=(String)$_FILES['file']['name'];
            
            $data=array(
                'slide_title'=>$slide_title,
                'mota'=>$mota,
                'url'=>$url,
                'trangthai'=>$trangthai,
                'user_id'=>$user_id,
                'time'=>$time,
                'img'=>$url_img_new,
            );
           
            db_insert('tbl_slide',$data);
            $_SESSION['result']="Thêm slide thành công";
            redirect("?mod=slide&action=list_slide");
           
        }
    }
    load_view('add_slide');
}
function edit_slideAction(){
    global $error,$time,$slide_title,$mota,$trangthai,$user_id,$url,$img,$img_name;
    $slide_id=(int)$_GET['slide_id'];
    $edit_slide=get_slide_by_id($slide_id);
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['slide_title'])){
            $error['slide_title']="Không được để trống Tiêu đề";
        }
        else{
            $slide_title=$_POST['slide_title'];       
        }
        if(empty($_POST['mota'])){
            $error['mota']="Không được để trống Mô tả ";
        }
        else{
            $mota=$_POST['mota'];       
        }
        
        if(empty($_POST['trangthai'])){
        $error['trangthai']="Không được để trống trạng thái";
        }
        else{
        $trangthai=$_POST['trangthai'];
        }
        $url=$_POST['url'];
        if(isset($_FILES['file'])){
            if(empty($_FILES['file']['name'])){
             $img_name=get_file_by_id('tbl_slide','slide_id',$slide_id);
            }
            else{
                 $upload_dir='public/images/';
                 // Đường dẫn của file sau khi upload
                 $upload_file=$upload_dir.$_FILES['file']['name'];
                 // xử lý upload đúng file ảnh
                 $type_allow=array('jpg','png','gift','jpeg');
                 // thư mục chứa file uploads
                 
                 $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                 // lấy đuôi file
                 // echo $type;
                 if(!in_array(strtolower($type),$type_allow)){
                     $error['type']='chỉ được upload file có đuôi jpg,png,gift,jpeg';
                 }
                 else{
                     # upload file có kích thước cho phép(20mb~ 29000000)
                     $file_size=$_FILES['file']['size'];
                     if($file_size>29000000){
                         $error['file_size']='chỉ được upload file bé hơn 20MB';
                     }
                     # kiểm tra trùng file trên hệ thống 
                     if(file_exists($upload_file)){
                         # kiểm tra trùng file trên hệ thống
                         //===================
                         // Xử lý tên file tự động
                         //===================
                         #Tạo file mới
                         // tên file.duoi file
                         $file_name=pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);
                         $new_file_name=$file_name.'-copy.';
                         $new_upload_file=$upload_dir.$new_file_name.$type;
                         $k=1;
                         while(file_exists($new_upload_file)){
                             $new_file_name=$file_name."-copy({$k}).";
                             $k++;
                             $new_upload_file=$upload_dir.$new_file_name.$type;
                         }
                         $upload_file=$new_upload_file;
                 
                         
                         // $error['file_exsts']='file đã tồn tại trên hệ thống';
                     }
                     $img_name=(String)$_FILES['file']['name'];
                 
                 }
            }
            
         }
        if(empty($error)){
            $name_img=create_slug($edit_slide['slide_title']).'-'.date('Y-m-d').''.rand(10,100000);
            resize_img($_FILES['file']['tmp_name'],$type,$name_img,760,380);

            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $img=$img_name;
            
            $data=array(
                'slide_title'=>$slide_title,
                'mota'=>$mota,
                'url'=>$url,
                'trangthai'=>$trangthai,
                'user_id'=>$user_id,
                'time'=>$time,
                'img'=>$url_img_new,
            );
            $file_name=explode(".",$edit_slide['img']);
                unlink("public/images/{$edit_slide['img']}");
                unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
            db_update('tbl_slide',$data,"`slide_id`='{$slide_id}'");
           
            redirect("?mod=slide&action=list_slide");
           
        }
    }
 
    $data['edit_slide']=$edit_slide;
    load_view('edit_slide',$data);
   
}
function list_slideAction(){
    // $list_slide=get_list_slide();
    // $data['list_slide']=$list_slide; 
    $num_row=db_num_rows("SELECT * FROM `tbl_post`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_slide=get_list_slide($start,$num_per_page);
    $data['list_slide']=$list_slide; 
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
    $_SESSION['successMsg']=$_SESSION['result'];
    unset($_SESSION['result']);
    $_SESSION['result']="";
    load_view('list_slide',$data);
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
        if(!empty($error)){
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $data=array(
                'page_title'=>$page_title,
                'page_detail'=>$page_detail,
                'trangthai'=>$trangthai,
                'user_id'=>$user_id,
                'time'=>$time,
            
            );
            db_update('tbl_page',$data,"`page_id`='{$page_id}'");
            redirect("?mod=page&action=list_page");
        }
       
    }
   
    $edit_page=get_page_by_id($page_id);
    $data['edit_page']=$edit_page;
    load_view('edit_page',$data);
}
function delete_slideAction(){
    $id=(int)$_GET['slide_id'];
    $delete_slide=get_slide_by_id($id);
    if(isset($_POST['btn-delete'])){
        $file_name=explode(".",$delete_slide['img']);
        unlink("public/images/{$delete_slide['img']}");
        unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
        db_delete('tbl_slide',"`slide_id`={$id}");

        // $_SESSION['result']="Xóa slide thành công !";
        redirect("?mod=slide&action=list_slide");
    }

  
    $data['delete_slide']=$delete_slide;
    load_view('delete_slide',$data);
}
function list_slide_garbageAction(){
    
    $list_slide=get_list_slide_garbage();
    $data['list_slide']=$list_slide;
    load_view('list_slide',$data);
}
function list_slide_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_slide=get_list_slide_th($trangthai);
    $data['list_slide']=$list_slide;
    load_view('list_slide',$data);
}
function trash_canAction(){
    global $slide_id;
    $slide_id=(int)$_GET['slide_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_slide',$data,"`slide_id`={$slide_id}");
    $_SESSION['result']="Slide đã được đưa vào thùng rác thành công!";
    redirect("?mod=slide&action=list_slide");
}
function restore_slideAction(){
    global $slide_id;
    $slide_id=(int)$_GET['slide_id'];
    $data=array(
        'thungrac'=>0
    );
    db_update('tbl_slide',$data,"`slide_id`={$slide_id}");
    $_SESSION['result']="Khôi phục slide thành công !";
    redirect("?mod=slide&action=list_slide");
}
?>

