<?php

$filename = 'img/gallery/nophoto.jpg';

if ( ! empty($_GET['file']) && file_exists($_GET['file'])){
    $filename = $_GET['file'];
}

image_resize( $filename , null, 174, 146);


function image_resize($src, $dst, $width, $height, $crop=0){

    if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

    $type = strtolower(substr(strrchr($src,"."),1));
    if($type == 'jpeg') $type = 'jpg';
    switch($type){
        case 'bmp': $img = imagecreatefromwbmp($src); break;
        case 'gif': $img = imagecreatefromgif($src); break;
        case 'jpg': $img = imagecreatefromjpeg($src); break;
        case 'png': $img = imagecreatefrompng($src); break;
        default : return "Unsupported picture type!";
    }

    $ratio = min($w/$width,$h/$height);
    
    $new = imagecreatetruecolor($width, $height);
    imagecopyresized($new, $img, 0, 0, 0, 0, $width, $height, $width*$ratio, $height*$ratio);
    
    header('Content-type: image/jpeg');
    imagejpeg( $new );

    return true;
}

?>