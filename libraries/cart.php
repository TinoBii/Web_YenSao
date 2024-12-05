<?php 


// function add_cart($id){
//     global $list_product;
//     $item=get_product_by_id($id);
// #thêm thông tin sản phẩm vào giỏ hàng
//     // print_r($item);
// $qty=1;
// if(isset($_SESSION['cart']['buy'])&& array_key_exists($id,$_SESSION['cart']['buy'])){
//     $qty= $_SESSION['cart']['buy'][$id]['qty']+1;
// }

// $_SESSION['cart']['buy'][$id]=array(
//     'product_id'=>$item['product_id'],
    
//     'product_title'=>$item['title'],
//     'price'=>$item['price'],
//     'product_thumb'=>$item['img'],
//     'qty'=>$qty,
//     'sub_total'=>$item['price'] * $qty
// );
// }

// function update_info_cart(){
//     $num_order=0;
//     $total=0;
//     foreach($_SESSION['cart']['buy'] as $item){
//         $num_order+=$item['qty'];
//         $total+=$item['sub_total'];
//     }
//     $_SESSION['cart']['info']=array(
//         'num_order'=>$num_order,
//         'total'=>$total,
//     );
// }

// function get_list_buy_cart(){
//     if(isset($_SESSION['cart'])){
//         foreach($_SESSION['cart']['buy'] as &$item){
//             $item['url_delete_cart']="?mod=cart&act=delete&id={$item['product_id']}";
//         }
//         return $_SESSION['cart']['buy'];
//     }
//     return false;
// }
// // sản phẩm trong trang chi tiết
// function get_num_order_cart(){
//     if(isset($_SESSION['cart'])){
//         return $_SESSION['cart']['info']['num_order'];
//     }
//     return false;
// }

// function get_total_cart(){
//     if(isset($_SESSION['cart'])){
//         return $_SESSION['cart']['info']['total'];
//     }
//     return false;
// }

// // xóa sản phẩm giỏ hàng
// function delete_cart($id){
//     if(isset($_SESSION['cart'])){
//     # Xóa sản phẩm có $id trong giỏ hàng
//         if(!empty($id)){
//             unset($_SESSION['cart']['buy'][$id]);
//             update_info_cart();
//         }
        
//         else{
//             unset($_SESSION['cart']);
//         }
//     }
    
// }

// // cập nhật giỏ hàng
// function update_cart($qty){
//     foreach($qty as $id=>$new_qty)
//     {
//         $_SESSION['cart']['buy'][$id]['qty']=$new_qty;
//         $_SESSION['cart']['buy'][$id]['sub_total']=$new_qty* $_SESSION['cart']['buy'][$id]['price'];
//     }
//     update_info_cart();
// }

?>