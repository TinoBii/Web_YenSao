<?php

function get_page_by_id($page_id){
    $result=db_fetch_row("SELECT * FROM `tbl_page` WHERE `page_id`='{$page_id}'");
    if(!empty($result)){
       
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}
function get_list_blog(){
    $result = db_fetch_array("SELECT * FROM `tbl_post`");
    return $result;
}
function get_blog_by_id($id){
    $result=db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='{$id}'");
    if(!empty($result)){
       
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}
function get_list_post(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `trangthai` = 'Công khai'");
    return $result;
}
function get_post_by_id($post_id){
    $result=db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='{$post_id}'");
    if(!empty($result)){
       
        return $result;
    }
    else{
        echo "không tồn tại";
    }
}