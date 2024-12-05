<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','order');
}

function indexAction(){
    $list_order=get_list_order();
    $data['list_order']=$list_order;
    load_view("index",$data);
}
