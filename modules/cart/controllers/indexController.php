<?php
function construct()
{
    load_model('index');
    load('lib','validation');
    load('lib','email');
    
}

function indexAction()
{
    //  unset($_SESSION['cart']);
     $list_product_inCart=get_list_buy_cart();
     // show_array($list_product_inCart);
     $data['list_product_inCart']=$list_product_inCart;
    //  show_array($data);
     load_view('index',$data);
    //  load_view('index');
}
function add_cartAction(){
    global $qty;
    $product_id=(int)$_GET['product_id']; 
    if(isset($_POST['add_cart'])){
        $qty=$_POST['num-order'];
    } 
    else{
        $qty=1;
    }
    add_cart($product_id,$qty);
    // update_info_cart();
    
    redirect('gio-hang.htm');
    
}
function checkoutAction()
{
    $list_product_inCart=get_list_buy_cart();
    $list_province=get_province();
    $data['list_province']=$list_province;
    $data['list_product_inCart']=$list_product_inCart;
    global $error,$hoten,$email,$province,$district,$sonha,$wards,$sdt,$GhiChu,$payment_method,$trangthai;
    if(isset($_POST['btn-dathang'])){
        $error=array();
        if(empty($_POST['hoten'])){
            $error['hoten']="Không được để trống họ tên";
        }
        else{
                $hoten=$_POST['hoten']; 
        }
        if(empty($_POST['email'])){
            $error['email']="Không được để trống email";
        }
        else{
                $email=$_POST['email']; 
        }
        if(empty($_POST['province'])){
            $error['province']="Không được để trống tỉnh/thành phố";
        }
        else{
            $id_province=(int)$_POST['province'];
            $province_name=get_province_by_id($id_province);
                $province=$province_name['name']; 
        }
        if(empty($_POST['district'])){
            $error['district']="Không được để trống Quận/Huyện";
        }
        else{
            $id_district=(int)$_POST['district'];
            $district_name=get_district_by_id($id_district);
                $district=$district_name['name']; 
        }
        if(empty($_POST['wards'])){
            $error['wards']="Không được để trống Phường/Xã";
        }
        else{
                $id_wards=(int)$_POST['wards'];
                $wards_name=get_wards_by_id($id_wards);
                $wards=$wards_name['name']; 
        }
        if(empty($_POST['sonha'])){
            $error['sonha']="Không được để trống số nhà";
        }
        else{
                $sonha=$_POST['sonha']; 
        }
        if(empty($_POST['sdt'])){
            $error['sdt']="Không được để trống số điện thoại";
        }
        else{
                $sdt=$_POST['sdt']; 
        }
        if(empty($_POST['payment_method'])){
            $error['payment_method']="Không được để trống hình thức thanh toán";
        }
        else{
                $payment_method=$_POST['payment_method']; 
        }
       
        $GhiChu=$_POST['GhiChu'];  
       
        if ($payment_method == "Thanh toán tại quầy") {
            $trangthai = "Thành công";
        } else {
            $trangthai = "Đang xử lý";
        }
        if(empty($error)){
            $data=array(
                'HoTen'=>$hoten,
                'email'=>$email,
                'province_id'=>$province,
                'district_id'=>$district,
                'ward_id'=>$wards,
                'sonha'=>$sonha,
                'sdt'=>$sdt,
                'GhiChu'=>$GhiChu
            );
            $id_kh=db_insert('tbl_khachhang',$data);
            $data_donhang=array(
                'NgayDat'=>date('d-m-Y'),
                'diachidh'=>$sonha.",".$wards.",".$district.",".$province,
                'ptthanhtoan'=>$payment_method,
                'trangthai'=>$trangthai,
                'id_kh'=>$id_kh,
        
            );
            $id_ddh=db_insert('tbl_dondathang',$data_donhang);
            $list_product_inCart=get_list_buy_cart();
            foreach($list_product_inCart as $item){
                $data_ctddh=array(
                    'id_ddh'=>$id_ddh,
                    'id_product'=>$item['product_id'],
                    'product_title'=>$item['product_title'],
                    'soluong'=>$item['qty'],
                    'DonGia'=>$item['sub_total']
                );
                db_insert('tbl_ctdondathang',$data_ctddh);
            }
            // delete_cart('');          
            $order=get_ddh_by_id($id_ddh);
            $data_order['order']=$order;
            send_mail("{$data['email']}","{$data['HoTen']}","Đặt hàng thành công",$id_ddh);
            delete_cart('');
            load_view('checkout_success',$data_order);
        }
        else{
            load_view('checkout',$data);
        }
    }
    else{
        load_view('checkout',$data);
    }
    
    
}
function buynowAction(){
    $product_id=$_GET['product_id'];
    $product=get_product_by_id($product_id);
    $list_province=get_province();
    $data['list_province']=$list_province;
    $data['product']=$product;
    global $error,$hoten,$email,$province,$district,$sonha,$wards,$sdt,$GhiChu,$payment_method,$trangthai;
    if(isset($_POST['btn-dathang'])){
        $error=array();
        if(empty($_POST['hoten'])){
            $error['hoten']="Không được để trống họ tên";
        }
        else{
                $hoten=$_POST['hoten']; 
        }
        if(empty($_POST['email'])){
            $error['email']="Không được để trống email";
        }
        else{
                $email=$_POST['email']; 
        }
        if(empty($_POST['province'])){
            $error['province']="Không được để trống tỉnh/thành phố";
        }
        else{
            $id_province=(int)$_POST['province'];
            $province_name=get_province_by_id($id_province);
                $province=$province_name['name']; 
        }
        if(empty($_POST['district'])){
            $error['district']="Không được để trống Quận/Huyện";
        }
        else{
            $id_district=(int)$_POST['district'];
            $district_name=get_district_by_id($id_district);
                $district=$district_name['name']; 
        }
        if(empty($_POST['wards'])){
            $error['wards']="Không được để trống Phường/Xã";
        }
        else{
                $id_wards=(int)$_POST['wards'];
                $wards_name=get_wards_by_id($id_wards);
                $wards=$wards_name['name']; 
        }
        if(empty($_POST['sonha'])){
            $error['sonha']="Không được để trống số nhà";
        }
        else{
                $sonha=$_POST['sonha']; 
        }
        if(empty($_POST['sdt'])){
            $error['sdt']="Không được để trống số điện thoại";
        }
        else{
                $sdt=$_POST['sdt']; 
        }
        if(empty($_POST['payment_method'])){
            $error['payment_method']="Không được để trống hình thức thanh toán";
        }
        else{
                $payment_method=$_POST['payment_method']; 
        }
       
        $GhiChu=$_POST['GhiChu'];  
       
        if ($payment_method == "Thanh toán tại quầy") {
            $trangthai = "Thành công";
        } else {
            $trangthai = "Đang xử lý";
        }
        if(empty($error)){
            $data=array(
                'HoTen'=>$hoten,
                'email'=>$email,
                'province_id'=>$province,
                'district_id'=>$district,
                'ward_id'=>$wards,
                'sonha'=>$sonha,
                'sdt'=>$sdt,
                'GhiChu'=>$GhiChu
            );
            $id_kh=db_insert('tbl_khachhang',$data);
            $data_donhang=array(
                'NgayDat'=>date('d-m-Y'),
                'diachidh'=>$sonha.",".$wards.",".$district.",".$province,
                'ptthanhtoan'=>$payment_method,
                'trangthai'=>$trangthai,
                'id_kh'=>$id_kh,
        
            );
            $id_ddh=db_insert('tbl_dondathang',$data_donhang);
          
            $data_ctddh=array(
                'id_ddh'=>$id_ddh,
                'id_product'=>$product['product_id'],
                'product_title'=>$product['title'],
                'soluong'=>1,
                'DonGia'=>$product['price']
            );
            db_insert('tbl_ctdondathang',$data_ctddh);
            
            // delete_cart('');          
            $order=get_ddh_by_id($id_ddh);
            $data_order['order']=$order;
            send_mail("{$data['email']}","{$data['HoTen']}","Đặt hàng thành công",$id_ddh);
            // delete_cart('');
            load_view('checkout_success',$data_order);
        }
        else{
            load_view('buynow',$data);
        }
    }
    else{
        load_view('buynow',$data);
    }
}
function checkout_successAction(){
    load_view('checkout_success');
}

function updateAction(){
    if(isset($_POST['btn_update_cart'])){
        //show_array($_POST);
        update_cart($_POST['qty']);
        redirect('?mod=cart&action=index');
    }
}
function update_slAction(){
    $id=(int)$_POST['data_id'];
    $new_qty=(int)$_POST['num_order'];
    $item=get_product_by_id($id);
    
    // cập nhật số lượng
    $_SESSION['cart']['buy'][$id]['qty']=$new_qty;
    // cập nhật tổng tiền
    $sub_total=$item['price']*$new_qty;
    $_SESSION['cart']['buy'][$id]['sub_total']=$sub_total;
    // cập nhật toàn bộ giỏ hàng
    update_info_cart();
    
    $total=get_total_cart();
    $num_order=$_SESSION['cart']['info']['num_order'];
    $result=array(
        'sub_total'=>currency_format($sub_total) ,
        'total'=>currency_format($total),
        'num_order'=>$num_order,
        'qty'=>$new_qty,
    );
    echo json_encode($result);
}

function deleteAction(){
    $id=$_GET['id'];
    delete_cart($id);
    update_info_cart();
    redirect('?mod=cart&action=index');
}
function ajax_get_districtAction(){
    $province_id = $_GET['province_id'];
    
   
    $result = get_district($province_id);

    $data[0] = [
        'id' => null,
        'name' => 'Chọn một Quận/huyện'
    ];
    foreach($result as $row) {
        $data[] = [
            'id' => $row['district_id'],
            'name'=> $row['name']
        ];
    }
    echo json_encode($data);
}
function ajax_get_wardsAction(){
    $district_id = $_GET['district_id'];

    // echo $district_id;
    
   
    $result = get_wards($district_id);


    $data[0] = [
        'id' => null,
        'name' => 'Chọn một xã/phường'
    ];

    foreach($result as $row) {
        $data[] = [
            'id' => $row['wards_id'],
            'name'=> $row['name']
        ];
    }
    echo json_encode($data);
}