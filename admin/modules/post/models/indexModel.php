<?php
function get_user_id_by_username($username){
    $item=db_fetch_row("SELECT * FROM `tbl_users` WHERE `username`='{$username}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
    
}
function get_list_post_cat(){
    $result = db_fetch_array("SELECT * FROM `tbl_danhmuc` ,`tbl_users` WHERE `tbl_danhmuc`.`user_id`=`tbl_users`.`user_id`");
    return $result;
}
function get_list_post($start=1,$num_per_page=10,$where=""){
    $result = db_fetch_array("SELECT * FROM `tbl_post` ,`tbl_danhmuc`,`tbl_users` WHERE `tbl_post`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_post`.`user_id`=`tbl_users`.`user_id` && `thungrac`='0' LIMIT {$start},{$num_per_page}");
    return $result;
}
function get_list_post_th($trangthai){
    if($trangthai==1){
        $result = db_fetch_array("SELECT * FROM `tbl_post` ,`tbl_post_cat`,`tbl_users` WHERE `tbl_post`.`post_cat_id`=`tbl_post_cat`.`post_cat_id` &&`tbl_post`.`user_id`=`tbl_users`.`user_id` && `thungrac`='0' && `tbl_post`.`trangthai`='Công khai'");
    }
    else{
        $result = db_fetch_array("SELECT * FROM `tbl_post` ,`tbl_post_cat`,`tbl_users` WHERE `tbl_post`.`post_cat_id`=`tbl_post_cat`.`post_cat_id` &&`tbl_post`.`user_id`=`tbl_users`.`user_id` && `thungrac`='0' && `tbl_post`.`trangthai`='Chờ duyệt'");
    }
   
    return $result;
}
function get_list_post_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` ,`tbl_danhmuc`,`tbl_users` WHERE `tbl_post`.`danhmuc_id`=`tbl_danhmuc`.`danhmuc_id` &&`tbl_post`.`user_id`=`tbl_users`.`user_id` && `thungrac`='1'");
    return $result;
}
function get_post_cat_by_cat_id($post_cat_id){
    $item=db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `post_cat_id`='{$post_cat_id}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_post_by_id($post_id){
    $item=db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='{$post_id}'");
    if(!empty($item)){
        return $item;
    }
    else{
        echo "không tồn tại";
    }
}
function get_level_by_cat($level){
    $level_cat=db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `post_cat_id`={$level}");
    if(!empty($level_cat)){
        $level_cat=$level_cat['level']+1;
        return $level_cat;
    }
    else{
        $level_cat=0;
        return $level_cat;
    }
}


function cat_post(){
    $data = db_fetch_array("SELECT * FROM `tbl_loaiproduct`");                   
    function has_child($data,$id){
        foreach($data as $v){
            if($v['cat_id_cha']==$id){
                return true;
            }
        }
        return false;
    }
    function render_menu($data,$parent_id=0,$level=0){
        if($level==0){
            $result="<ul class='list-item'>";
        }
        else{
            $result="<ul class='sub-menu'>";
        }
        foreach($data as $v){
            if($v['cat_id_cha']==$parent_id){
                $result.="<li>";
                $result.=" <a href='?page=category_product' title=''>{$v['cat_title']}</a>";
                if(has_child($data,$v['cat_id'])){
                    $result.=render_menu($data,$v['cat_id'],$level+1);
                }
                $result.="</li>";
            }
        }
        $result.="</ul>";
        return $result;
    }
}

?>