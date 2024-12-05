<?php 
    function get_list_categories(){
        $result = db_fetch_array("SELECT * FROM `tbl_danhmuc`");
        return $result;
    }

    function get_level_by_categories($cap){
        $level_cat=db_fetch_row("SELECT * FROM `tbl_danhmuc` WHERE `cat_id`={$cap}");
        if($level_cat>0){
            $level_cat=$level_cat['cap']+1;
            return $level_cat;
        }
        else{
            $level_cat=1;
            return $level_cat;
        }
    }

    function get_user_id_by_username($username){
        $item=db_fetch_row("SELECT * FROM `tbl_users` WHERE `username`='{$username}'");
        if(!empty($item)){
            return $item;
        }
        else{
            echo "không tồn tại";
        }
        
    }

    function get_categories_by_id($danhmuc_id){
        $result=db_fetch_row("SELECT * FROM `tbl_danhmuc` WHERE `danhmuc_id`='{$danhmuc_id}'");
        if(!empty($result)){
        
            return $result;
        }
        else{
            echo "không tồn tại";
        }
        
    }
?>