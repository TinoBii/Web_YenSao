<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','banner');
    load('lib','pagging');
}

function add_bannerAction(){
    global $error,$time,$banner_title,$mota,$trangthai,$user_id,$url,$img,$loai_banner, $img_name;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['banner_title'])){
            $error['banner_title']="Không được để trống Tiêu đề";
        }
        else{
            $banner_title=$_POST['banner_title'];       
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
        if(empty($_POST['loai_banner'])){
        $error['loai_banner']="Không được để trống loại banner";
        }
        else{
        $loai_banner=$_POST['loai_banner'];
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
            $name_img=create_slug($banner_title).'-'.date('Y-m-d').''.rand(10,100000);
            // resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);   
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");

            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $img=(String)$_FILES['file']['name'];
            
            $data=array(
                'banner_title'=>$banner_title,
                'mota'=>$mota,
                'url'=>$url,
                'trangthai'=>$trangthai,
                'loai_banner'=>$loai_banner,
                'user_id'=>$user_id,
                'time'=>$time,
                'img'=>$url_img_new,
            );
           
            db_insert('tbl_banner',$data);
            $_SESSION['result']="Thêm banner thành công";
            redirect("?mod=banner&action=list_banner");
           
        }
    }
    load_view('add_banner');
}
function edit_bannerAction(){
    global $error,$time,$banner_title,$mota,$trangthai,$user_id,$url,$img,$img_name,$loai_banner;
    $banner_id=(int)$_GET['banner_id'];
    $edit_banner=get_banner_by_id($banner_id);
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['banner_title'])){
            $error['banner_title']="Không được để trống Tiêu đề";
        }
        else{
            $banner_title=$_POST['banner_title'];       
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
        if(empty($_POST['loai_banner'])){
            $error['loai_banner']="Không được để trống loại banner";
            }
            else{
            $loai_banner=$_POST['loai_banner'];
            }
        $url=$_POST['url'];
        if(isset($_FILES['file'])){
            if(empty($_FILES['file']['name'])){
             $img_name=get_file_by_id('tbl_slide','slide_id',$banner_id);
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
                   
                    $img_name=$new_file_name.$type;
                }
            }
            
         }
        if(empty($error)){
            if(!empty($_FILES['file']['name'])){
                $name_img=create_slug($edit_banner['banner_title']).'-'.date('Y-m-d').''.rand(10,100000);
                // resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
                $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                $url_img_new=$name_img.'.'.$type;
                rename("public/images/{$img_name}","public/images/{$url_img_new}");

                $user=get_user_id_by_username(user_login());
                $user_id=$user['user_id'];
                $time=date('d/m/Y - H:i:s');
            
                
                $data=array(
                    'banner_title'=>$banner_title,
                    'mota'=>$mota,
                    'url'=>$url,
                    'trangthai'=>$trangthai,
                    'user_id'=>$user_id,
                    'loai_banner'=>$loai_banner,
                    'time'=>$time,
                    'img'=>$url_img_new,
                );
                $file_name=explode(".",$edit_banner['img']);
                unlink("public/images/{$edit_banner['img']}");
                unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
                db_update('tbl_banner',$data,"`banner_id`='{$banner_id}'");
            }
            redirect("?mod=banner&action=list_banner");
           
        }
    }
    
    $data['edit_banner']=$edit_banner;
    load_view('edit_banner',$data);
   
}
function list_bannerAction(){
    // $list_banner=get_list_banner();
    // $data['list_banner']=$list_banner; 
    $num_row=db_num_rows("SELECT * FROM `tbl_banner`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_banner=get_list_banner($start,$num_per_page);
    $data['list_banner']=$list_banner;
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
    $_SESSION['successMsg']=$_SESSION['result'];
    unset($_SESSION['result']);
    $_SESSION['result']="";
    load_view('list_banner',$data);
}

function delete_bannerAction(){
    $id=(int)$_GET['banner_id'];
    $delete_banner=get_banner_by_id($id);
    if(isset($_POST['btn-delete'])){
        $file_name=explode(".",$delete_banner['img']);
        unlink("public/images/{$delete_banner['img']}");
        unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
        db_delete('tbl_banner',"`banner_id`={$id}");
        $_SESSION['result']="Xóa banner thành công !";
        redirect("?mod=banner&action=list_banner");
    }

   
    $data['delete_banner']=$delete_banner;
    load_view('delete_banner',$data);
}
function list_banner_garbageAction(){
    
    $list_banner=get_list_banner_garbage();
    $data['list_banner']=$list_banner;
    load_view('list_banner',$data);
}
function list_banner_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_banner=get_list_banner_th($trangthai);
    $data['list_banner']=$list_banner;
    load_view('list_banner',$data);
}
function trash_canAction(){
    global $banner_id;
    $banner_id=(int)$_GET['banner_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_banner',$data,"`banner_id`={$banner_id}");
    $_SESSION['result']="Banner đã được đưa vào thùng rác thành công!";
    redirect("?mod=banner&action=list_banner");
}
function restore_bannerAction(){
    global $banner_id;
    $banner_id=(int)$_GET['banner_id'];
    $data=array(
        'thungrac'=>0
    );
    db_update('tbl_banner',$data,"`banner_id`={$banner_id}");
    $_SESSION['result']="Khôi phục banner thành công !";
    redirect("?mod=banner&action=list_banner");
}
?>

