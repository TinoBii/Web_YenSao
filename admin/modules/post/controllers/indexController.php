<?php
function construct(){
    load_model('index');
    load('lib','validation');
    load('lib','post');
    load('lib','pagging');
}
function indexAction(){
    load_view("index");
}
function list_postAction(){
    $num_row=db_num_rows("SELECT * FROM `tbl_post`");
    $num_per_page=10;
    //Tổng số lượng bản ghi
    $total_row=$num_row;
    // số lượng trang
    $num_page=ceil($total_row/$num_per_page);
    $page=isset($_GET['page'])?(int)$_GET['page']:1;
    // chỉ số xuất phát
    $start=($page-1)*$num_per_page;
    $list_post=get_list_post($start,$num_per_page);
    $data['list_post']=$list_post;
    $pagging=[
        'num_page'=>$num_page,
        'page'=>$page,
        'start'=>$start
    ];
    $data['pagging']=$pagging;
   
    load_view('list_post',$data);
    // $list_post=get_list_postt();
    // $data['list_post']=$list_post;
    // load_view('list_post',$data);
}
function list_post_catAction(){
    $list_post_cat=get_list_post_cat();
    $data['list_post_cat']=$list_post_cat;
    load_view('list_post_cat',$data);
}
function add_postAction(){
    global $img,$post_title,$post_detail,$error,$post_description,$trangthai,$noibat,$img_name,$danhmuc_id;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['post_title'])){
            $error['post_title']="Không được để trống Tiêu đề";
        }
        else{
            $post_title=$_POST['post_title'];       
        }


        if(empty($_POST['post_detail'])){
            $error['post_detail']="Không được để trống Mô tả ngắn";
        }
        else{
            $post_detail=$_POST['post_detail'];       
        }


        if(empty($_POST['post_description'])){
            $error['post_description']="Không được để trống Mô tả chi tiết";
        }
        else{
            $post_description=$_POST['post_description'];       
        }


        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống trạng thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        

        if(empty($_POST['noibat'])){
            $noibat=1;
        }
        else{
            $noibat=$_POST['noibat'];
        }
        
        if(empty($_POST['danhmuc_id'])){
            $error['danhmuc_id']="Không được để trống Danh mục cha";
        }
        else{
            $danhmuc_id=$_POST['danhmuc_id'];
        }

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
                    
                    // $error['file_exsts']='file đã tồn tại trên hệ thống';
                }
                $img_name=$file_name.'.'.$type;
            }
        }
        if(empty($error)){
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $name_img=create_slug($post_title).'-'.date('Y-m-d').''.rand(10,100000);
            resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);                               
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);

            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");

            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            
            $data=array(
                'post_title'=>$post_title,
                'post_description'=>$post_description,
                'post_detail'=>$post_detail,
                'user_id'=>$user_id,
                'time'=>$time,
                'trangthai'=>$trangthai,
                'noibat' => $noibat,
                'img'=>$url_img_new,
                'danhmuc_id'=>$danhmuc_id
            );
            
            db_insert('tbl_post',$data);
            echo '<script>alert("Thêm sản phẩm thành công!")</script>';
            redirect("?mod=post&action=list_post");
        }
    }
    $list_post_cat=get_list_post_cat();
    $data['list_post_cat']=$list_post_cat;
    load_view('add_post',$data);
}
function edit_postAction(){
    global $img,$post_title,$post_detail,$error,$post_description,$trangthai,$noibat,$post_cat_id,$post_id,$img_name;
    $post_id=(int)$_GET['post_id'];
    $post=get_post_by_id($post_id);

    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['post_title'])){
            $error['post_title']="Không được để trống Tiêu đề";
        }
        else{
            $post_title=$_POST['post_title'];       
        }
        if(empty($_POST['post_detail'])){
            $error['post_detail']="Không được để trống Mô tả ngắn";
        }
        else{
            $post_detail=$_POST['post_detail'];       
        }
        if(empty($_POST['post_description'])){
            $error['post_description']="Không được để trống Mô tả chi tiết";
        }
        else{
            $post_description=$_POST['post_description'];       
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống trạng thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        if(empty($_POST['noibat'])){
            $noibat=1;
        }
        else{
            $noibat=$_POST['noibat'];
        }

        if(empty($_POST['post_cat_id'])){
            $error['post_cat_id']="Không được để trống Danh mục cha";
        }
        else{
            $post_cat_id=$_POST['post_cat_id'];
        }
        if(isset($_FILES['file'])){
            if(empty($_FILES['file']['name'])){
            $img_name=get_file_by_id('tbl_post','post_id',$post_id);
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
                $name_img=create_slug($post['post_title']).'-'.date('Y-m-d').''.rand(10,100000);
                resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);                               
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);

                $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                $url_img_new=$name_img.'.'.$type;
                rename("public/images/{$img_name}","public/images/{$url_img_new}");

                $user=get_user_id_by_username(user_login());
                $user_id=$user['user_id'];
                $time=date('d/m/Y - H:i:s');
                $img=$img_name;
            
                $data=array(
                    'post_title'=>$post_title,
                    'post_description'=>$post_description,
                    'post_detail'=>$post_detail,
                    'user_id'=>$user_id,
                    'post_cat_id'=>$post_cat_id,
                    'time'=>$time,
                    'trangthai'=>$trangthai,
                    'noibat' => $noibat,
                    'img'=>$url_img_new

                );
                $file_name=explode(".",$post['img']);
                unlink("public/images/{$post['img']}");
                unlink("public/images/{$file_name[0]}-thump.{$file_name[1]}");
                db_update('tbl_post',$data,"`post_id`='{$post_id}'"); 
            }          
            redirect("?mod=post&action=list_post");
           
        }
    }
    
    $data['post']=$post;
    $list_post_cat=get_list_post_cat();
    $data['list_post_cat']=$list_post_cat;
    load_view('edit_post',$data);
}
function add_catAction(){
    global $error,$post_cat_title,$user_id,$time,$trangthai,$post_cat_cha;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['post_cat_title'])){
            $error['post_cat_title']="Không được để trống tên danh mục";
        }
        else{
            $post_cat_title=$_POST['post_cat_title'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống trạng thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        if(empty($_POST['level'])){
            $error['level']="Không được để trống danh mục cha";
        }
        else{
            $post_cat_cha=$_POST['level'];
        }
        $user=get_user_id_by_username(user_login());
        $user_id=$user['user_id'];
        $time=date('d/m/Y - H:i:s');
        $level=get_level_by_cat($post_cat_cha);
        $data=array(
            'post_cat_title'=>$post_cat_title,
            'user_id'=>$user_id,
            'time'=>$time,
            'trangthai'=>$trangthai,
            'post_cat_cha'=>$post_cat_cha,
            'level'=>$level
        );
        
        db_insert('tbl_post_cat',$data);
        redirect("?mod=post&action=list_post_cat");
    }
    $list_post_cat=get_list_post_cat();
    $data['list_post_cat']=$list_post_cat;
    load_view('add_cat',$data);

}
function edit_catAction(){  
    global $error,$post_cat_title,$user_id,$time,$trangthai,$post_cat_id,$post_cat;
    $post_cat_id=(int)$_GET['cat_id'];
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['post_cat_title'])){
            $error['post_cat_title']="Không được để trống tên danh mục";
        }
        else{
            $post_cat_title=$_POST['post_cat_title'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Không được để trống trạng thái";
        }
        else{
            $trangthai=$_POST['trangthai'];
        }
        $user=get_user_id_by_username(user_login());
        $user_id=$user['user_id'];
        $time=date('d/m/Y - H:i:s');
        $data=array(
            'post_cat_title'=>$post_cat_title,
            'user_id'=>$user_id,
            'time'=>$time,
            'trangthai'=>$trangthai
        );
        db_update('tbl_post_cat',$data,"`post_cat_id`='{$post_cat_id}'");
        redirect("?mod=post&action=list_post_cat");
    }
    
    $post_cat=get_post_cat_by_cat_id($post_cat_id);
    $data['post_cat']=$post_cat;
    load_view('edit_cat',$data);
}
function list_cat_post(){
    $data = db_fetch_array("SELECT * FROM `tbl_loaiproduct`");
    $cat_post =render_menu($data);
}
function list_post_garbageAction(){
    $list_post=get_list_post_garbage();
    $data['list_post']=$list_post;
    // load_view('list_product',$data);
    load_view('list_post',$data);
}
function list_post_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_post=get_list_post_th($trangthai);
    $data['list_post']=$list_post;  
    load_view('list_post',$data);
}
function trash_canAction(){
    global $post_id;
    $post_id=(int)$_GET['post_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_post',$data,"`post_id`={$post_id}");
    redirect("?mod=post&action=list_post");
}
function restore_postAction(){
    global $post_id;
    $post_id=(int)$_GET['post_id'];
    $data=array(
        'thungrac'=>0
    );
    db_update('tbl_post',$data,"`post_id`={$post_id}");
    redirect("?mod=post&action=list_post");
}

function delete_postAction(){
    $post_id=(int)$_GET['post_id'];
    $post=get_post_by_id($post_id);
    if(isset($_POST['btn-delete'])){
        $file_name=explode(".",$post['img']);
        unlink("public/images/{$post['img']}");
        unlink("public/images/{$file_name[0]}-thump.{$file_name[1]}");

        db_delete('tbl_post',"`post_id`={$post_id}");
        redirect("?mod=post&action=list_post");
    }
    $data['post']=$post;
    $list_post_cat=get_list_post_cat();
    $data['list_post_cat']=$list_post_cat;
    load_view('delete_post',$data);
}
