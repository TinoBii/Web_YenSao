<?php
// contruct là hàm dùng chung
function construct(){
    // echo "dung chung ,load đầu tiên <br>";
    load_model('index');
    load('lib','validation');
    load('lib','email');
}

function add_contactAction() {
    global $error, $fullname, $email, $phone_number, $content, $job, $img, $kieu;

    if (isset($_POST['btn-upload'])) {
        $error = array();

        // Xử lý thông tin phản hồi khách hàng
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống nội dung phản hồi";
        } else {
            $content = $_POST['content'];
        }

        if (!empty($_POST['job'])) {
            $job = $_POST['job'];
        }
        
        if (!empty($_POST['feedback_type'])) {
            $kieu = $_POST['feedback_type'];
        } else {
            $kieu = 2;  
        }

        // Xử lý ảnh phản hồi (nếu có)
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


        if (empty($error)) {

            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $name_img=create_slug($title).'-'.date('Y-m-d').''.rand(10,100000);
            resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);                               
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            
            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");

            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'content' => $content,
                'job' => $job,
                'img' => $url_img_new,
                'kieu' => $kieu,
                'created_at' => date('Y-m-d H:i:s')
            );
            var_dump($data);
            db_insert('tbl_lienhe', $data);
            $_SESSION['result'] = "Gửi phản hồi thành công!";
            redirect("?mod=contact&action=list_contact");
        }
    }
    $list_contact=get_list_contact();
    $data['list_contact']=$list_contact;
    load_view('add_contact',$data);
}

function list_contactAction(){
    $list_contact=get_list_contact();
    $data['list_contact']=$list_contact;    
    load_view('list_contact',$data);
}

function edit_contactAction(){
    $lienhe_id=(int)$_GET['lienhe_id'];

    global  $error, $fullname, $email, $phone_number, $content, $job, $img, $kieu;
    $edit_contact=get_contact_by_id($lienhe_id);
    if(isset($_POST['btn-edit'])){
        $error=array();
        // Xử lý thông tin phản hồi khách hàng
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống nội dung phản hồi";
        } else {
            $content = $_POST['content'];
        }

        if (!empty($_POST['job'])) {
            $job = $_POST['job'];
        }
        

        // Kiểm tra kiểu phản hồi (Liên hệ hoặc Phản hồi khách hàng)
        if (!empty($_POST['feedback_type'])) {
            $kieu = $_POST['feedback_type'];
        } else {
            $kieu = 2;  // Mặc định là liên hệ nếu không có lựa chọn
        }

        // Xử lý ảnh phản hồi (nếu có)
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
                else{
                    $img_name=$file_name.'.'.$type;
                }
            }
        }  
        if(empty($error)){
            if(!empty($_FILES['file']['name'])){
                $name_img=create_slug($edit_contact['title']).'-'.date('Y-m-d').''.rand(10,100000);
                resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);      
                $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                $url_img_new=$name_img.'.'.$type;
                rename("public/images/{$img_name}","public/images/{$url_img_new}");

                $data=array(               
                    'img'=>$url_img_new,                  
                );

                $file_name=explode(".",$edit_contact['img']);
                unlink("public/images/{$edit_contact['img']}");
                unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
                db_update('tbl_lienhe',$data,"`lienhe_id`='{$lienhe_id}'");
                // $sql="UPDATE `tbl_product` SET `title`='{$title}',`description`='{$description}',`price`='{$price}',`soluong`='{$soluong}',`detail`='{$detail}',`img`='{$img}',`cat_id`='{$cat_id}',`trangthai`='{$trangthai}',`user_id`='{$user_id}',`time`='{$time}',`noibat`='{$noibat}' WHERE `product_id`='{$product_id}'";
                // db_query($sql);
                echo '<script>alert("Thêm sản phẩm thành công!")</script>';
            }
            $time=date('d/m/Y - H:i:s');
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'content' => $content,
                'job' => $job,
                'img' => $url_img_new,
                'kieu' => $kieu,
                'created_at' => date('Y-m-d H:i:s')
            );
            db_update('tbl_lienhe',$data,"`lienhe_id`='{$lienhe_id}'");
            redirect("?mod=contact&action=list_contact");           
        }
        else{
            show_array($error);
        }
    } 
    $data['edit_contact']=$edit_contact;
    load_view('edit_contact',$data);
}

function trash_canAction(){
    global $lienhe_id;
    $lienhe_id=(int)$_GET['lienhe_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_lienhe',$data,"`lienhe_id`={$lienhe_id}");
    $_SESSION['result']="Đã được đưa vào thùng rác thành công!";
    redirect("?mod=contact&action=list_contact");
}

function list_contact_garbageAction(){
    $list_contact=get_list_contact_garbage();
    $data['list_contact']=$list_contact;
    load_view('list_contact',$data);
}

function delete_contactAction(){
    $lienhe_id=(int)$_GET['lienhe_id'];
    $contact=get_contact_by_id($lienhe_id);
    if(isset($_POST['btn-delete'])){

        $file_name=explode(".",$contact['img']);
        unlink("public/images/{$contact['img']}");
        unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
        db_delete('tbl_lienhe',"`lienhe_id`={$lienhe_id}");
        $_SESSION['result']="Xóa Sản phẩm thành công !";
        redirect("?mod=contact&action=list_contact");
    }
    $delete_contact=get_contact_by_id($lienhe_id);
    $data['delete_contact']=$delete_contact;
    load_view('delete_contact',$data);
}

?>