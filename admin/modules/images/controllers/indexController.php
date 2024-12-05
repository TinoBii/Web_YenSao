<?php

use Aws\S3\Exception\RedirectException;

function construct() {
    load_model('index');
    load('lib','validation');
    load('lib','product');
    load('lib','pagging');
}
function add_imgAction(){
    global $data_img,$error;
    $product_id=(int)$_GET['product_id'];
    $product=get_product_by_id($product_id);
    $stt=get_stt_by_id( $product_id);
    $_SESSION['product_id_img']=$product_id;
    if(isset($_POST['btn-upload'])){
        if(isset($_FILES['files'])){
            $uploadedFiles = $_FILES['files'];
            //  show_array($uploadedFiles);
            for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
                $stt++;
                $upload_dir='public/images/';
                // Đường dẫn của file sau khi upload
                $upload_file=$upload_dir.$uploadedFiles['name'][$i];
                // xử lý upload đúng file ảnh
                $type_allow=array('jpg','png','gift','jpeg');
                // thư mục chứa file uploads
                $type=pathinfo($uploadedFiles['name'][$i],PATHINFO_EXTENSION);
                $file_name=pathinfo($uploadedFiles['name'][$i],PATHINFO_FILENAME);
                // lấy đuôi file
                // echo $type;
                if(!in_array(strtolower($type),$type_allow)){
                    $error['type']='chỉ được upload file có đuôi jpg,png,gift,jpeg';
                }
                else{
                    # upload file có kích thước cho phép(20mb~ 29000000)
                    $file_size1=$uploadedFiles['size'][$i];
                    if($file_size1>29000000){
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
                        $file_name=pathinfo($uploadedFiles['name'][$i],PATHINFO_FILENAME);
                        $new_file_name=$file_name.'-copy.';
                        $new_upload_file=$upload_dir.$new_file_name.$type;
                        $k=1;
                        while(file_exists($new_upload_file)){
                            $new_file_name=$file_name."-copy({$k}).";
                            $k++;
                            $new_upload_file=$upload_dir.$new_file_name.$type;
                        }
                        $upload_files=$new_upload_file;
                        $name_img=create_slug($product['title']).'-'.date('Y-m-d').''.rand(10,100000);
                        $data_img[]=[
                            'name_img'=>$new_file_name,
                            'url_img'=>$new_file_name.$type,
                            'name_mahoa'=>$name_img,
                            'type'=>$type,
                            'upload_files'=>$upload_files,
                            'tmpFilePath' => $uploadedFiles['tmp_name'][$i],
                            'stt' => $stt
                        ];  
                        
                        resize_img($uploadedFiles['tmp_name'][$i],$type,$name_img,300,300);                      
                       
                    
                    } 
                    else{
                        $name_img=create_slug($product['title']).'-'.date('Y-m-d').''.rand(10,100000);
                        $data_img[]=[
                            'name_img'=>$file_name,
                            'url_img'=>$file_name.'.'.$type,
                            'name_mahoa'=>$name_img,
                            'type'=>$type,
                            'upload_files'=>$upload_dir.$file_name.'.'.$type,
                            'tmpFilePath' => $uploadedFiles['tmp_name'][$i],
                            'stt' => $stt
                        ]; 
                        resize_img($uploadedFiles['tmp_name'][$i],$type,$name_img,300,300);                      
                    } 
                }
            }
            show_array($data_img);
            if(empty($error)){   
                // show_array($data_img);  
                
                foreach($data_img as $item){
                     move_uploaded_file($item['tmpFilePath'],$item['upload_files']);
                    //  $name_img=create_slug($product['title']).'-'.date('Y-m-d').''.rand(10,100000);
                     $url_img_new=$item['name_mahoa'].'.'.$item['type'];
                    rename("public/images/{$item['url_img']}","public/images/{$url_img_new}");
                    $data_image=[
        
                        'name_img'=>$item['name_mahoa'],
                        'url_img'=>$url_img_new,
                        'id_cha'=>$product_id,
                        'loai_img'=>1,
                        'stt'=>$item['stt']
                    ];


                    db_insert('tbl_images',$data_image);

                }
            
                 redirect("?mod=images&action=add_img&product_id=".$product_id);                                
            }     
         }
    }
    $list_img=get_list_img_by_id($product_id);
   
    $data['list_img']=$list_img;
    $data['product']=$product;
    return load_view('add_img',$data);
}
function delete_imgAction(){
    $id_img=(int)$_GET['id_img'];
    $img_product=get_img_by_id($id_img);
    if(isset($_POST['btn-delete'])){
        $file_name=explode(".",$img_product['url_img']);
        unlink("public/images/{$img_product['url_img']}");
        unlink("public/images/{$img_product['name_img']}_thump.{$file_name[1]}");
        db_delete('tbl_images',"`id_img`={$id_img}");   
        redirect("?mod=images&action=add_img&product_id=".$_SESSION['product_id_img']);  
    }
   
    $data['img_product']=$img_product;
    return load_view('delete_img',$data);
}
function edit_imgAction(){
    global $img_name,$stt,$error;
    $id_img=(int)$_GET['id_img'];
    $img_product=get_img_by_id($id_img);
    $max_stt=get_stt_by_id($_SESSION['product_id_img']);
    if(isset($_POST['btn-edit'])){
        $error=array();
        if(empty($_POST['stt'])){
            $error['title']="Không được để trống số thứ tự";
        }
        else{
            if($_POST['stt']>$max_stt || $_POST['stt']<=0)
            {
                $error['stt']="Số thứ tự nằm trong khoảng từ 1 đến {$max_stt}";
            }else{
                 $stt=$_POST['stt'];    
            }                            
        }      
        if(isset($_FILES['file'])){
            if(empty($_FILES['file']['name'])){
             $img_name=get_name_by_id('tbl_images','id_img',$id_img);

            }
            else{
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
                     else{
                        $img_name=$file_name.'.'.$type;
                     }                  
                 }
            }            
         }       
        if(empty($error)){
            if(!empty($_FILES['file']['name'])){
                $product=get_product_by_id($img_product['id_cha']);
                $name_img=create_slug($product['title']).'-'.date('Y-m-d').''.rand(10,100000);
                resize_img($_FILES['file']['tmp_name'],$type,$name_img,300,300);                               
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_file);          
                $type=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                $url_img_new=$name_img.'.'.$type;
                
                rename("public/images/{$img_name}","public/images/{$url_img_new}");                       
                $data_edit=array(               
                'name_img'=>$name_img,
                'url_img'=>$url_img_new,
                );  
                
                $file_name=explode(".",$img_product['url_img']);
                unlink("public/images/{$img_product['url_img']}");
                unlink("public/images/{$img_product['name_img']}_thump.{$file_name[1]}");

                db_update('tbl_images',$data_edit,"`id_img`='{$id_img}'"); 
            }else{
                $img_edit=get_img_by_id($id_img);
                $id_img_bd=get_img_by_stt($stt);
                $data=array(               
                    'stt'=>$img_edit['stt']
                ); 
                db_update('tbl_images',$data,"`id_img`='{$id_img_bd['id_img']}'"); 
                $data_edit=array(               
                    'stt'=>$stt
                );     
            }
           
            db_update('tbl_images',$data_edit,"`id_img`='{$id_img}'"); 
            redirect("?mod=images&action=add_img&product_id=".$_SESSION['product_id_img']);    
                    
        }
       
        
    }
  
    $data['img_product']=$img_product;
    $data['max_stt']=$max_stt;
    return load_view('edit_img',$data);
}

