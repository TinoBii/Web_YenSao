

<?php
// contruct là hàm dùng chung
function construct(){
    // echo "dung chung ,load đầu tiên <br>";
    load_model('index');
    load('lib','validation');
    load('lib','email');
}


function loginAction(){
    // echo date('d/m/Y');
    global $error,$username,$password;
    if(isset($_POST['btn-login'])){
        $error=array();
       
        if(empty($_POST['username'])){
            $error['username']="không được để trống username";
        }
        else{
           if(!is_username($_POST['username'])){
                $error['username']="Không đúng định dạng của username";
            }
        
            else{
                $username=$_POST['username'];
            }
        }

        if(empty($_POST['password'])){
            $error['password']="không được để trống password";
        }
        else{
           if(!is_password($_POST['password'])){
                $error['password']="Không đúng định dạng của password";
            }
        
            else{
                $password=md5($_POST['password']);
            }
        }
        if(empty($error)){
            if(check_login($username,$password)){
                $_SESSION['is_login']=true;
                $_SESSION['user_login']=$username;
                redirect('?mod=home');

            }
        }
    }
    load_view('login');
}

function logoutAction(){
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect();
}
function resetAction(){
    global $error,$email,$password;
    $reset_token=$_GET['reset_token'];
    echo $reset_token;
    if(!empty($reset_token)){
        if(check_reset_token($reset_token)){
            if(isset($_POST['btn-new-pass'])){
                $error=array();
                echo $_POST['btn-new-pass'];
                if(empty($_POST['password'])){
                    $error['password']="không được để trống password";
                }
                else{
                   if(!is_password($_POST['password'])){
                        $error['password']="Không đúng định dạng của password";
                    }
                    else{
                        $password=md5($_POST['password']);
                    }
                }
                if(empty($error)){
                    $data=array(
                        'password'=>$password
                    );
                    update_pass($data,$reset_token);
                    redirect("?mod=users&action=resetok");
                }
            } 
            
        }
        else{
            echo "yêu cầu lấy lại mật khẩu không tồn tại";
        }  
        load_view("newPass");
    }
    else{
        if(isset($_POST['btn-reset'])){
        $error=array();
        if(empty($_POST['email'])){
            $error['email']="Không được để tróng email";
        }
        else{
            $email=$_POST['email'];
        }       
        if(empty($error)){
            if(check_email($email)){
                $reset_token=md5($email.time());
                $data=array(              
                    'reset_token'=>$reset_token
                );
                // cập nhật mã reset pass cho user cần khôi phục
                update_reset_token($data,$email);
                $link=base_url("?mod=users&action=reset&reset_token={$reset_token}");
                $content="<p>Bạn vui lòng click vào link sau để thiết lập lại mật khẩu : {$link}</p>
                <p>Nếu không phải yêu cầu của bạn , bạn vui lòng bỏ qua Email này</p>";
                echo send_mail("{$email}","","Khôi phục mật khẩu",$content);
                echo "email có tồn tại";
               
            }
            else{
                $error['account']="Email không tồn tại trên hệ thống";
            }
           
        }
        // load_view('reset');
    }
    } 
    load_view('reset');
}

function indexAction(){
    $list_user=get_list_users();
    $data['list_user']=$list_user;
    load_view('index',$data);
    
}
// function add_user(){

// }
function updateAction(){
    if(isset($_POST['btn-update'])){
       
        global $error;
        $error=array();
        if(empty($_POST['fullname'])){
           $error['fullname']= "Không được để trống fullname";
        }
        else{
            $fullname=$_POST['fullname'];
        }
        if(empty($_POST['phone_number'])){
            $error['phone_number']= "Không được để trống phone_number";
        }
        else{
            $phone_number=$_POST['phone_number'];
        }
        $address=$_POST['address'];
      
        if(empty($error)){
            $data=array(
                'fullname'=>$fullname,
                'address'=>$address,
                'phone_number'=>$phone_number,
                
            );
            update_user_login(user_login(),$data);
        }  
    }
    $info_user=get_user_by_username(user_login());
    // show_array($info_user);
    $data['info_user']=$info_user;
    load_view('update',$data);
}
function add_userAction(){
    global $error,$fullname,$username,$sdt,$email,$password;
    if(isset($_POST['btn-add'])){
        $error=array();
        if(empty($_POST['fullname'])){
            $error['fullname']="Không được để trống họ tên";
        }
        else{
            $fullname=$_POST['fullname'];
        }
        if(empty($_POST['username'])){
            $error['username']="Không được để trống username";
        }
        else{
            if(!is_username($_POST['username'])){
                 $error['username']="Không đúng định dạng của username";
             }
         
             else{
                 $username=$_POST['username'];
             }
         }

        if(empty($_POST['sdt'])){
            $error['sdt']="Không được để trống sdt";
        }
        else{
            if(!is_phone_number($_POST['sdt'])){
                 $error['sdt']="Không đúng định dạng của sdt";
             }
         
             else{
                 $sdt=$_POST['sdt'];
             }
         }
        if(empty($_POST['email'])){
            $error['email']="Không được để trống email";
        }
        else{
            if(check_email($_POST['email'])){
                 $error['email']="email đã tồn tại";
             }
         
             else{
                 $email=$_POST['email'];
             }
         }
        if(empty($_POST['password'])){
            $error['password']="Không được để trống sdt";
        }
        else{
            if(!is_password($_POST['password'])){
                 $error['password']="Không đúng định dạng của password";
             }
         
             else{
                 $password=md5($_POST['password']);
             }
         }
         if(empty($error)){
            $time=date('d/m/Y - H:i:s');
            $data=array(
                'fullname'=>$fullname,
                'username'=>$username,
                'phone_number'=>$sdt,
                'email'=>$email,
                'created_date'=>$time,
                'password'=>$password
            );
            db_insert('tbl_users',$data);
            redirect("?mod=users&action=index");
        }
    }
    load_view('add');
}

?>