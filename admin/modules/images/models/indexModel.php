<?php

function get_product_by_id($product_id){
    $result=db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`='{$product_id}'");
    if(!empty($result)){
       
        return $result;
    }
    else{
        echo "không tồn tại";
    }
   
}
function get_list_img_by_id($product_id){
    $item=db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_cha` = {$product_id} AND `loai_img`=1 ORDER BY `stt` DESC");
    return $item;
}
function get_img_by_id($product_id){
    $item=db_fetch_row("SELECT * FROM `tbl_images` WHERE `id_img` = {$product_id} AND `loai_img`=1");
    return $item;
}
function get_stt_by_id($product_id){
    $img=db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_cha`={$product_id}");
    $stt=array();
    if(!empty($img)){
       foreach($img as $item){
            $stt[]=$item['stt'];  
       }
       return max($stt);
    }
   return 0;
}
function get_img_by_stt($stt){
    $item=db_fetch_row("SELECT * FROM `tbl_images` WHERE `stt` = {$stt} AND `loai_img`=1 AND `id_cha`={$_SESSION['product_id_img']}");
    return $item;
}


// function resizeImage($resourceType,$image_width,$image_height) {
//     $resizeWidth = 200;
//     $resizeHeight = 200;
//     $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
//     imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
//     return $imageLayer;
// }

// function resize_img($tmp_name,$type,$name_img){
//     $fileName = $tmp_name;
//              $file="";          
//     $sourceProperties = getimagesize($fileName);
//     $resizeFileName = $name_img;
//     $uploadPath = "public/images/";
//   //   $uploadPath = "./uploads/";
//     $fileExt = $type;
//     $uploadImageType = $sourceProperties[2];
//     $sourceImageWidth = $sourceProperties[0];
//     $sourceImageHeight = $sourceProperties[1];
//     switch ($uploadImageType) {
//         case IMAGETYPE_JPEG:
//             $resourceType = imagecreatefromjpeg($fileName); 
//             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//             imagejpeg($imageLayer,$uploadPath.$resizeFileName.'-thump.'. $fileExt);
//             break;

//         case IMAGETYPE_GIF:
//             $resourceType = imagecreatefromgif($fileName); 
//             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//             imagegif($imageLayer,$uploadPath.$resizeFileName.'-thump.'. $fileExt);
//             break;

//         case IMAGETYPE_PNG:
//             $resourceType = imagecreatefrompng($fileName); 
//             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//             imagepng($imageLayer,$uploadPath.$resizeFileName.'-thump.'. $fileExt);
//             break;

//         default:
//             $imageProcess = 0;
//             break;
//     }
//     move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
// }