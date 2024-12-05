<?php

use Aws\S3\Exception\RedirectException;

function construct() {
    load_model('index');
    load('lib','validation');
    load('lib','product');
    load('lib','pagging');
}

function indexAction() {
    load_view('index');
}
function add_productAction(){ 
    global $error,$noibat, $user_id ,$title,$price,$description,$detail,$img,$soluong,$cat_id,$danhmuc_id,$trangthai,$time,$img_name,$discount,$price_discount,$cap1,$ten_cap1,$cap2,$ten_cap2,$cap3,$ten_cap3,$cap4,$ten_cap4;
    if(isset($_POST['btn-upload'])){
        $error=array();
        if(empty($_POST['title'])){
            $error['title']="Không được để trống tên sản phẩm";
        }
        else{
            $title=$_POST['title'];        
        }

        if(empty($_POST['price'])){
            $error['price']="Không được để trống giá sản phẩm";
        }
        else{
            $price=$_POST['price'];
        }

        if(!empty($_POST['discount'])){
            $discount=$_POST['discount'];
        } else {
            $discount = 0; 
        }
        
        if(!empty($_POST['price_discount'])){
            $price_discount=$_POST['price_discount'];
        } else {
            $price_discount = 0;
        }

        if(!empty($_POST['description'])){
            $description=$_POST['description'];
        }

        if(!empty($_POST['detail'])){
            $detail=$_POST['detail'];
        }

        if(empty($_POST['soluong'])){
            $error['soluong']="Không được để trống mô tả chi tiết sản phẩm";
        }
        else{
            $soluong=$_POST['soluong'];
        }

        if(empty($_POST['cat_id'])){
            $cat_id= 0;
        }
        else {
            $cat_id=$_POST['cat_id'];
        }   

        if(empty($_POST['danhmuc_id'])){
            $error['danhmuc_id']= "Không để trống loại sản phẩm";
        }
        else {
            $danhmuc_id=$_POST['danhmuc_id'];         
        }

        $trangthai=$_POST['trangthai'];
        if(empty($_POST['noibat'])){
            $noibat=1;
        }
        else{
            $noibat=$_POST['noibat'];
        }

        if(empty($_POST['cap1'])){
            $cap1=0;
        }
        else{
            $cap1=$_POST['cap1'];
        }
        if(!empty($cap1)){
            $ten_cap1=get_ten_dm_by_id($cap1)['ten_danhmuc'];
        }

        if(empty($_POST['cap2'])){
            $cap2=0;
        }
        else{
            $cap2=$_POST['cap2'];
        }
        if(!empty($cap2)){
            $ten_cap2=get_ten_dm_by_id($cap2)['ten_danhmuc'];
        }

        if(empty($_POST['cap3'])){
            $cap3=0;
        }
        else{
            $cap3=$_POST['cap3'];
        }
        if(!empty($cap3)){
            $ten_cap3=get_ten_dm_by_id($cap3)['ten_danhmuc'];
        }

        if(empty($_POST['cap4'])){
            $cap4=0;
        }
        else{
            $cap4=$_POST['cap4'];
        }
        
        if(!empty($cap4)){
            $ten_cap4=get_ten_dm_by_id($cap4)['ten_danhmuc'];
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
                    
                }
                $img_name=$file_name.'.'.$type;
            }
        }
        
        if(empty($error)){    
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $name_img=create_slug($title).'-'.date('Y-m-d').''.rand(10,100000);
            resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);                               
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            
            $url_img_new=$name_img.'.'.$type;
            rename("public/images/{$img_name}","public/images/{$url_img_new}");

            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            
            $data=array(               
                'title'=>$title,
                'description'=>$description,
                'price'=>$price,
                'soluong'=>$soluong,
                'detail'=>$detail,
                'img'=>$url_img_new,
                'cat_id'=>$cat_id,
                'trangthai'=>$trangthai,
                'user_id'=>$user_id,
                'time'=>$time,
                'noibat'=>$noibat,
                'discount'=>$discount,
                'cap1'=>$cap1,
                'ten_cap1'=>$ten_cap1,
                'cap2'=>$cap2,
                'ten_cap2'=>$ten_cap2,
                'cap3'=>$cap3,
                'ten_cap3'=>$ten_cap3,
                'cap4'=>$cap4,
                'ten_cap4'=>$ten_cap4,
                'danhmuc_id'=>$danhmuc_id,
                'price_discount'=>$price_discount

            );
            db_insert('tbl_product',$data);
            $_SESSION['result']="Thêm Sản phẩm thành công !";
            redirect("?mod=product&action=list_product");                           
        }       
    }
    $list_cat=get_list_cat_product();
    $data['list_cat']=$list_cat;
    load_view('add_product',$data);
}


function list_productAction(){
    $list_product=get_list_product();
    $data['list_product']=$list_product;    
    load_view('list_product',$data);
}


function edit_productAction(){
    $product_id=(int)$_GET['product_id'];

    global $error,$noibat,$edit_product, $user_id ,$title,$price,$description,$detail,$img,$soluong,$cat_id,$danhmuc_id,$trangthai,$time,$img_name,$discount,$price_discount,$cap1,$ten_cap1,$cap2,$ten_cap2,$cap3,$ten_cap3,$cap4,$ten_cap4;
    $edit_product=get_product_by_id($product_id);
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['title'])){
            $error['title']="Không được để trống tên sản phẩm";
        }
        else{
                $title=$_POST['title'];                 
        }      
        if(empty($_POST['price'])){
            $error['price']="Không được để trống giá sản phẩm";
        }
        else{
            $price=$_POST['price'];
        }
        if(!empty($_POST['discount'])){
            $discount=$_POST['discount'];
        } else {
            $discount = 0; 
        }
        
        if(!empty($_POST['price_discount'])){
            $price_discount=$_POST['price_discount'];
        } else {
            $price_discount = 0;
        }
        if(!empty($_POST['description'])){
            $description=$_POST['description'];
        }

        if(!empty($_POST['detail'])){
            $detail=$_POST['detail'];
        }
        else{
            $detail=$_POST['detail'];
        }
        if(empty($_POST['soluong'])){
            $error['soluong']="Không được để trống mô tả chi tiết sản phẩm";
        }
        else{
            $soluong=$_POST['soluong'];
        }
        if(empty($_POST['cat_id'])){
            $cat_id= 0;
        }
        else {
            $cat_id=$_POST['cat_id'];
        }   

        if(empty($_POST['danhmuc_id'])){
            $error['danhmuc_id']= "Không để trống loại sản phẩm";
        }
        else {
            $danhmuc_id=$_POST['danhmuc_id'];         
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']= "cần chọn trạng thái sản phẩm";
        }
        else {
            $trangthai=$_POST['trangthai'];
        }
        if(empty($_POST['cap1'])){
            $cap1=0;
        }
        else{
            $cap1=$_POST['cap1'];
        }
        if(!empty($cap1)){
            $ten_cap1=get_ten_dm_by_id($cap1)['ten_danhmuc'];
        }

        if(empty($_POST['cap2'])){
            $cap2=0;
        }
        else{
            $cap2=$_POST['cap2'];
        }
        if(!empty($cap2)){
            $ten_cap2=get_ten_dm_by_id($cap2)['ten_danhmuc'];
        }

        if(empty($_POST['cap3'])){
            $cap3=0;
        }
        else{
            $cap3=$_POST['cap3'];
        }
        if(!empty($cap3)){
            $ten_cap3=get_ten_dm_by_id($cap3)['ten_danhmuc'];
        }

        if(empty($_POST['cap4'])){
            $cap4=0;
        }
        else{
            $cap4=$_POST['cap4'];
        }
        if(empty($_POST['noibat'])){
            $noibat=0;
        }
        else{
            $noibat=$_POST['noibat'];  
        }
        if(!empty($cap4)){
            $ten_cap4=get_ten_dm_by_id($cap4)['ten_danhmuc'];
        }
        if(isset($_FILES['file'])){
            if(empty($_FILES['file']['name'])){
            $img_name=get_file_by_id('tbl_product','product_id',$product_id);
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
                $name_img=create_slug($edit_product['title']).'-'.date('Y-m-d').''.rand(10,100000);
                resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);      
                $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                $url_img_new=$name_img.'.'.$type;
                rename("public/images/{$img_name}","public/images/{$url_img_new}");

                
            
                $data=array(               
                    'img'=>$url_img_new,                  
                );

                $file_name=explode(".",$edit_product['img']);
                unlink("public/images/{$edit_product['img']}");
                unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
                db_update('tbl_product',$data,"`product_id`='{$product_id}'");
                // $sql="UPDATE `tbl_product` SET `title`='{$title}',`description`='{$description}',`price`='{$price}',`soluong`='{$soluong}',`detail`='{$detail}',`img`='{$img}',`cat_id`='{$cat_id}',`trangthai`='{$trangthai}',`user_id`='{$user_id}',`time`='{$time}',`noibat`='{$noibat}' WHERE `product_id`='{$product_id}'";
                // db_query($sql);
                echo '<script>alert("Thêm sản phẩm thành công!")</script>';
            }
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $data=array(               
                'title'=>$title,
                'description'=>$description,
                'price'=>$price,
                'soluong'=>$soluong,
                'detail'=>$detail, 
                'cat_id'=>$cat_id,
                'danhmuc_id'=>$danhmuc_id,
                'trangthai'=>$trangthai,
                'user_id'=>$user_id,
                'time'=>$time,
                'cap1'=>$cap1,
                'ten_cap1'=>$ten_cap1,
                'cap2'=>$cap2,
                'ten_cap2'=>$ten_cap2,
                'cap3'=>$cap3,
                'ten_cap3'=>$ten_cap3,
                'cap4'=>$cap4,
                'ten_cap4'=>$ten_cap4,
                'discount'=>$discount,
                'price_discount'=>$price_discount,
                'noibat'=>$noibat

            );
            db_update('tbl_product',$data,"`product_id`='{$product_id}'");
            redirect("?mod=product&action=list_product");           
        }
        else{
            show_array($error);
        }
    } 
    $data['edit_product']=$edit_product;
    $list_cat=get_list_cat_product();
    $data['list_cat']=$list_cat;
    load_view('edit_product',$data);
}
function trash_canAction(){
    global $product_id;
    $product_id=(int)$_GET['product_id'];
    $data=array(
        'thungrac'=>1
    );
    db_update('tbl_product',$data,"`product_id`={$product_id}");
    $_SESSION['result']="Sản phẩm đã được đưa vào thùng rác thành công!";
    redirect("?mod=product&action=list_product");
}
function restore_productAction(){
    global $product_id;
    $product_id=(int)$_GET['product_id'];
    $data=array(
        'thungrac'=>0
    );
    db_update('tbl_product',$data,"`product_id`={$product_id}");
    $_SESSION['result']="Khôi phục slide thành công !";
    redirect("?mod=product&action=list_product");
    
}
function list_product_garbageAction(){
    $list_product=get_list_product_garbage();
    $data['list_product']=$list_product;
    // load_view('list_product',$data);
    load_view('list_product',$data);
}
function list_product_trangthaiAction(){
    $trangthai=(int)$_GET['trangthai'];
    $list_product=get_list_product_th($trangthai);
    $data['list_product']=$list_product;  
    load_view('list_product',$data);
}
function delete_productAction(){
    $product_id=(int)$_GET['product_id'];
    $product=get_product_by_id($product_id);
    if(isset($_POST['btn-delete'])){

        $file_name=explode(".",$product['img']);
        unlink("public/images/{$product['img']}");
        unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");

        db_delete('tbl_images',"`id_cha`={$product_id}");
        db_delete('tbl_product',"`product_id`={$product_id}");
        $_SESSION['result']="Xóa Sản phẩm thành công !";
        redirect("?mod=product&action=list_product");
    }
    $delete_product=get_product_by_id($product_id);
    $data['delete_product']=$delete_product;
    $list_cat=get_list_cat_product();
    $data['list_cat']=$list_cat;
    load_view('delete_product',$data);
}
function list_catAction(){
    $list_cat=get_list_cat_product();
    $data['list_cat']=$list_cat;
    load_view('list_cat',$data);
}
function add_catAction(){
    global $error,$cat_id_cha,$level,$cat_title,$trangthai,$user_id,$time,$img_name,$noibat;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['cat_title'])){
            $error['cat_title']="Tên danh mục không được để trống";
        }
        else{
            $cat_title=$_POST['cat_title'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Trạng thái không được để trống";
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
        if(empty($_POST['level'])){
        $level=0;
        }
        else{
        $level=$_POST['level'];
        }
        if(isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE){

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
                else{
                    $img_name=$file_name.'.'.$type;
                }
            }
        }
        else
        {
            $img_name = null;
        }
        if(empty($error)){
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            $img=$img_name;
            $cat_id_cha=$_POST['level'];
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $time=date('d/m/Y - H:i:s');
            $level=get_level_by_cat($level);
            $data=array(
                'cat_title'=>$cat_title,
                'user_id'=>$user_id,
                'time'=>$time,
                'noibat'=>$noibat,
                'trangthai'=>$trangthai,
                'level'=>$level,
                'img_cat'=>$img,
                'cat_id_cha'=>$cat_id_cha
            );
            // show_array($data);
            // Hàm insert
            db_insert("tbl_loaiproduct",$data);
            redirect("?mod=product&action=list_cat");
        }
    }
    $list_cat=get_list_cat_product();
    $data['list_cat']=$list_cat;
    load_view('list_cat',$data);
}
function edit_catAction(){
    
    global $error,$cat_title,$trangthai,$user_id,$time,$cat_id;
    $cat_id=(int)$_GET['cat_id'];
    
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['cat_title'])){
            $error['cat_title']="Tên danh mục không được để trống";
        }
        else{
            $cat_title=$_POST['cat_title'];
        }
        if(empty($_POST['trangthai'])){
            $error['trangthai']="Trạng thái không được để trống";
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
        if(isset($_FILES['file'])){

            $upload_dir='public/images/';
            // Đường dẫn của file sau khi upload
            $upload_file=$upload_dir.$_FILES['file']['name'];
            // xử lý upload đúng file ảnh
            $type_allow=array('jpg','png','gift','jpeg');
            // thư mục chứa file uploads
            
            $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            // lấy đuôi file
            $file_name=pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);

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
                else{
                    $img_name=$file_name.'.'.$type;
                }
            }
        }
        if(empty($error)){
            move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            $img=$img_name;
            $time=date('d/m/Y - H:i:s');
            $data=array(
                'cat_title'=>$cat_title,
                'user_id'=>$user_id,
                'time'=>$time,
                'img_cat'=>$img,
                'trangthai'=>$trangthai,
                'noibat'=>$noibat
            );
            // Hàm insert
            db_update('tbl_loaiproduct',$data,"`cat_id`={$cat_id}");
            redirect("?mod=product&action=list_cat");
        }
    }
    $cat_by_id=get_cat_by_id($cat_id);
    $data['edit_cat']=$cat_by_id;
    load_view('edit_cat',$data);
}


function ajax_get_danhmucAction() {
    $danhmuc_id = $_POST['id'];
    $cap = $_POST['cap'];
    $danhmuc_con = get_cap_by_parent_id($danhmuc_id);
    
    echo '<option value="">--Chọn Cấp '.$cap.' --</option>';
    foreach ($danhmuc_con as $option) {
        $selected = (set_value('cap'.$cap) == $option['danhmuc_id']) ? 'selected' : '';
        echo "<option value='{$option['danhmuc_id']}' $selected>{$option['ten_danhmuc']}</option>";
    }
}



