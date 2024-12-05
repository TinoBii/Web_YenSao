<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','product');
}

function indexAction() {  
    $list_slide=get_list_slide();
    $list_banner_trai=get_list_banner_trai();
    $list_banner_tren=get_list_banner_tren();
    $list_product=get_list_product();
    $list_product_banchay=get_list_product_banchay();
    $list_post=get_list_post();
    $product_cat=get_product_cat();
    $list_product_sale = get_list_product_sale();
    $list_contact=get_list_contact();
    $data['list_slide']=$list_slide;
    $data['list_banner_trai']=$list_banner_trai;
    $data['list_banner_tren']=$list_banner_tren;
    $data['list_product_banchay']=$list_product_banchay;
    $data['list_product']=$list_product;
    $data['list_post']=$list_post;
    $data['product_cat']=$product_cat;
    $data['list_product_sale'] = $list_product_sale;
    $data['list_contact'] = $list_contact;
    load_view('index',$data);
}

function detailAction(){
    $product_id=(int) $_GET['product_id'];
    $product_detail=get_product_by_id($product_id);
    
    $data['product_detail']=$product_detail;
    
    load_view('detail',$data);
}

function detail_postAction(){
    $post_id=(int) $_GET['post_id'];
    $post_detail=get_post_by_id($post_id);
    $data['post_detail']=$post_detail;
    load_view('detail_post',$data);
}

function searchAction(){
    $string=(string)$_POST['text_input'];
    if(!empty($string)){
        $list_search=get_product_by_string($string);
        //$list_search=get_product_by_string($string);
        // show_array($list_search);
        // echo 1;
        // echo $string;
        $result=[
            'list_search'=>$list_search
        ];
        echo json_encode($result);
    }
}

function loadmenuAction(){
    $danhmuc_id=(int) $_GET['danhmuc_id'];
    $danhmuc_detail=get_categories_by_id($danhmuc_id);
    if( $danhmuc_detail['kieu'] == 1){
        $data['danhmuc_detail']=$danhmuc_detail;
        load_view_diff_mod('gioithieu',$data,'page');
    }
    elseif($danhmuc_detail['kieu'] == 2){
        $data['danhmuc_detail']=$danhmuc_detail;
        load_view_diff_mod('product',$data,'product');
    }
    elseif($danhmuc_detail['kieu'] == 3){
        $data['danhmuc_detail']=$danhmuc_detail;
        load_view_diff_mod('tin_tuc',$data,'page');
    }
    elseif($danhmuc_detail['kieu'] == 4){
        $data['danhmuc_detail']=$danhmuc_detail;
        load_view_diff_mod('chinhsach',$data,'page');
    }
}


