<?php
// contruct là hàm dùng chung
function construct(){
    // echo "dung chung ,load đầu tiên <br>";
    load_model('index');
    load('lib','validation');
    load('lib','email');
}

function list_categoriesAction(){
    $list_categories=get_list_categories();
    $data['list_categories']=$list_categories;    
    load_view('list_categories',$data);
}

function add_categoriesAction() {
    global $error, $cap, $kieu, $ten_danhmuc, $trangthai, $danhmuc_id_cha, $noibat, $user_id;

    if (isset($_POST['btn-upload'])) {
        $error = array();

        if (empty($_POST['cap'])) {
            $error['cap'] = "Không được để trống cấp";
        } else {
            $cap = $_POST['cap'];
        }

        if (empty($_POST['kieu'])) {
            $error['kieu'] = "Không được để trống kiểu";
        } else {
            $kieu = $_POST['kieu'];
        }

        if (empty($_POST['ten_danhmuc'])) {
            $error['ten_danhmuc'] = "Không được để trống tên danh mục";
        } else {
            $ten_danhmuc = $_POST['ten_danhmuc'];
        }

        if (empty($_POST['trangthai'])) {
            $error['trangthai'] = "Không được để trống trạng thái";
        } else {
            $trangthai = $_POST['trangthai'];
        }

        if (!empty($_POST['danhmuc_id_cha'])) {
            $danhmuc_id_cha = $_POST['danhmuc_id_cha'];
        } else {
            $danhmuc_id_cha = 0; // Giá trị mặc định nếu không có danh mục cha
        }

        if (!empty($_POST['noibat'])) {
            $noibat = $_POST['noibat'];
        } else {
            $noibat = 1; // Mặc định không nổi bật nếu không có lựa chọn
        }

        if (empty($error)) {
            $user=get_user_id_by_username(user_login());
            $user_id=$user['user_id'];
            
            $data = array(
                'cap' => $cap,
                'kieu' => $kieu,
                'ten_danhmuc' => $ten_danhmuc,
                'trangthai' => $trangthai,
                'danhmuc_id_cha' => $danhmuc_id_cha,
                'noibat' => $noibat,
                'user_id' => $user_id
            );
            var_dump($data);
            db_insert('tbl_danhmuc', $data);
            $_SESSION['result'] = "Thêm danh mục thành công!";
            redirect("?mod=categories&action=list_categories");
        }
    }
    $list_categories = get_list_categories();
    $data['list_categories'] = $list_categories;
    load_view('add_categories', $data);
}

function edit_categoriesAction(){
    $danhmuc_id = (int)$_GET['danhmuc_id'];

    global $error, $kieu, $cap, $ten_danhmuc, $trangthai, $danhmuc_id_cha, $noibat, $edit_categories;

    if(isset($_POST['btn-edit'])){
        $error = array();

        if(empty($_POST['kieu'])){
            $error['kieu'] = "Không được để trống kiểu danh mục";
        } else {
            $kieu = $_POST['kieu'];
        }

        if(empty($_POST['cap'])){
            $error['cap'] = "Không được để trống cấp danh mục";
        } else {
            $cap = $_POST['cap'];
        }

        if(empty($_POST['ten_danhmuc'])){
            $error['ten_danhmuc'] = "Không được để trống tên danh mục";
        } else {
            $ten_danhmuc = $_POST['ten_danhmuc'];
        }

        if(empty($_POST['trangthai'])){
            $error['trangthai'] = "Cần chọn trạng thái danh mục";
        } else {
            $trangthai = $_POST['trangthai'];
        }

        if (!empty($_POST['danhmuc_id_cha'])) {
            $danhmuc_id_cha = $_POST['danhmuc_id_cha'];
        } else {
            $danhmuc_id_cha = 0;
        }

        if (!empty($_POST['noibat'])) {
            $noibat = $_POST['noibat'];
        } else {
            $noibat = 1; 
        }

        if(empty($error)){
            $data = array(
                'kieu' => $kieu,
                'cap' => $cap,
                'ten_danhmuc' => $ten_danhmuc,
                'trangthai' => $trangthai,
                'danhmuc_id_cha' => $danhmuc_id_cha,
                'noibat' => $noibat,
            );

            db_update('tbl_danhmuc', $data, "`danhmuc_id`='{$danhmuc_id}'");
            redirect("?mod=categories&action=list_categories");
        } else {
            show_array($error);
        }
    }
    $danhmuc_by_id=get_categories_by_id($danhmuc_id);
    $data['edit_categories']=$danhmuc_by_id;
    load_view('edit_categories', $data);
}

function delete_categoriesAction(){
    $danhmuc_id=(int)$_GET['danhmuc_id'];
    $categories=get_categories_by_id($danhmuc_id);
    if(isset($_POST['btn-delete'])){

        $file_name=explode(".",$categories['img']);
        unlink("public/images/{$categories['img']}");
        unlink("public/images/{$file_name[0]}_thump.{$file_name[1]}");
        db_delete('tbl_danhmuc',"`danhmuc_id`={$danhmuc_id}");
        $_SESSION['result']="Xóa danh mục thành công !";
        redirect("?mod=categories&action=list_categories");
    }
    $delete_categories=get_categories_by_id($danhmuc_id);
    $data['delete_categories']=$delete_categories;
    load_view('delete_categories',$data);
}

?>