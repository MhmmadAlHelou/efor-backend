<?php

include '../../connect.php';

$table = 'items';

$id = filterRequest('id');
$name = filterRequest('name');
$namear = filterRequest('namear');
$desc = filterRequest('desc');
$descar = filterRequest('descar');
$count = filterRequest('count');
$active = filterRequest('active');
$price = filterRequest('price');
$discount = filterRequest('discount');
$catid = filterRequest('catid');
$oldcat = filterRequest('oldcat');
$newcat = filterRequest('newcat');

$imageold = filterRequest('imageold');

// if($catid == '1'){
//     $res = imageUpload("../../upload/items/men",'files');
// }else if($catid == '2'){
//     $res = imageUpload("../../upload/items/women",'files');
// }else if($catid == '5'){
//     $res = imageUpload("../../upload/items/kids",'files');
// }
$res = imageUpload("../../upload/items/$newcat",'files');


if($oldcat != $newcat){
    rename("../../upload/items/$oldcat/$imageold","../../upload/items/$newcat/$imageold");
}
// exec("move ../../upload/items/men ../../upload/items/men");



if($res == 'empty'){
    $data = array(
        'items_name'     => $name,
        'items_name_ar'  => $namear,
        'items_desc'     => $desc,
        'items_desc_ar'  => $descar,
        'items_count'    => $count,
        'items_active'   => $active,
        'items_price'    => $price,
        'items_discount' => $discount,
        'items_cat'      => $catid,#
    );
}else{

    // if($catid == '1'){
    //     deleteFile("../../upload/items/$oldcat",$imageold);
    // }else if($catid == '2'){
    //     deleteFile("../../upload/items/$oldcat",$imageold);
    // }else if($catid == '5'){
    //     deleteFile("../../upload/items/$oldcat",$imageold);
    // }

    deleteFile("../../upload/items/$oldcat",$imageold);

    $data = array(
        'items_name'     => $name,
        'items_name_ar'  => $namear,
        'items_desc'     => $desc,
        'items_desc_ar'  => $descar,
        'items_image'    => $res,
        'items_count'    => $count,
        'items_active'   => $active,
        'items_price'    => $price,
        'items_discount' => $discount,
        'items_cat'      => $catid,#
    );
}

updateData($table,$data,"items_id = $id");