<?php

function get_list_contact(){
    $result = db_fetch_array("SELECT * FROM `tbl_lienhe` WHERE `thungrac`='0'");
    return $result;
}

function get_contact_by_id($lienhe_id){
    $result=db_fetch_row("SELECT * FROM `tbl_lienhe` WHERE `lienhe_id`='{$lienhe_id}'");
    if(!empty($result)){
    
        return $result;
    }
    else{
        echo "không tồn tại";
    }
    
}

function get_total_contact_rac(){
    $result = db_fetch_array("SELECT * FROM `tbl_lienhe` WHERE `thungrac`='1'");
    return count($result);
}

function get_list_contact_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_lienhe` WHERE `thungrac`='1'");
    return $result;
}

?>