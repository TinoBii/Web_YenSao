<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('lib','product');
    // load('lib','cart');
}

function indexAction() {  
    $list_product=get_list_product();
    $data['list_product']=$list_product;
    load_view('index',$data);
}
function product_newAction(){
    $list_product=get_list_product();
    $data['list_product']=$list_product;
    load_view('product_new',$data);
}
function detail_productAction(){
    $product_id=(int) $_GET['product_id'];
    $product_detail=get_product_by_id($product_id);
    $data['product_detail']=$product_detail;
    $list_product=get_list_product();
    $list_img=get_list_img_by_id($product_id);
    $data['list_img']=$list_img;
    $data['list_product']=$list_product;
    load_view('detail_product',$data);
}
function list_product_catidAction(){
    $danhmuc_id=(int) $_GET['danhmuc_id'];
    $cat_product=get_cat_by_id($danhmuc_id);
    $list_product=get_list_product_by_cat_id($danhmuc_id);
    $data['list_product']=$list_product;
    $data['cat_product']=$cat_product;
    load_view('product_by_cat',$data);
}
function search_productAction(){
    $string=(string)$_POST['s'];
        $list_search=get_product_by_string($string);
        $data['list_product']=$list_search;
        load_view('index',$data);
}

function sortAction(){
    $string=(string)$_POST['order_by'];
    $list_search=get_product_by_string($string);
    $dataSearch = '';
    foreach($list_search as $item){
        $dataItem = `
        <li class="clearfix">
            <a href="?mod=product&action=detail_product&product_id=" class="thumb-search fl-left">
                <img style="height: 100% !important;" src="admin/public/images/">
            </a>
            <div class="info fl-right">
                <a href="?mod=product&action=detail_product&product_id=.html" class="product-name"></a>
                <span class="price">{$item['price']}</span>
                <a href="" class="buy-now">Mua ngay</a>
            </div>
        </li>  `;
        $dataSearch+=$dataItem;
    }
    $result=[
        'list_search'=>$dataSearch
    ];
    echo json_encode($result);   
}

