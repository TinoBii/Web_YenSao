<?php
function resizeImage($resourceType,$image_width,$image_height,$width_thump,$height_thump) {
	
    $resizeWidth = $width_thump;
    $resizeHeight = $height_thump;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function resize_img($tmp_name,$type,$name_img,$width_thump,$height_thump){
    $fileName = $tmp_name;
             $file="";          
    $sourceProperties = getimagesize($fileName);
    $resizeFileName = $name_img;
    $uploadPath = "public/images/";
  //   $uploadPath = "./uploads/";
    $fileExt = $type;
    $uploadImageType = $sourceProperties[2];
    $sourceImageWidth = $sourceProperties[0];
    $sourceImageHeight = $sourceProperties[1];
    switch ($uploadImageType) {
        case IMAGETYPE_JPEG:
            $resourceType = imagecreatefromjpeg($fileName); 
            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$width_thump,$height_thump);
            imagejpeg($imageLayer,$uploadPath.$resizeFileName.'_thump.'. $fileExt);
            break;

        case IMAGETYPE_GIF:
            $resourceType = imagecreatefromgif($fileName); 
            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$width_thump,$height_thump);
            imagegif($imageLayer,$uploadPath.$resizeFileName.'_thump.'. $fileExt);
            break;

        case IMAGETYPE_PNG:
            $resourceType = imagecreatefrompng($fileName); 
            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$width_thump,$height_thump);
            imagepng($imageLayer,$uploadPath.$resizeFileName.'_thump.'. $fileExt);
            break;

        default:
            $imageProcess = 0;
            break;
    }
    move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
}