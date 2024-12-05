<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
   load_view('index');
}
function contactAction() {
   load_view('contact');
}

 function blogAction(){  
   $list_post=get_list_post();
   $data['list_post']=$list_post;
    load_view('blog',$data);
 }
 function detail_postAction(){
   $post_id=(int) $_GET['post_id'];
   $post_detail=get_post_by_id($post_id);
   $data['post_detail']=$post_detail;
   load_view('detail_post',$data);
}
