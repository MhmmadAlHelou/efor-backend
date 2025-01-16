<?php

include '../../connect.php';

$table = 'items';
$name = filterRequest('name');
$namear = filterRequest('namear');
$desc = filterRequest('desc');
$descar = filterRequest('descar');
$count = filterRequest('count');
// $active = filterRequest('active');
$price = filterRequest('price');
$discount = filterRequest('discount');
$datenow = filterRequest('datenow');
$catid = filterRequest('catid');
$catname = filterRequest('catname');

// if($catid == '1'){
//     $imagename = imageUpload("../../upload/items/men",'files');
// }else if($catid == '2'){
//     $imagename = imageUpload("../../upload/items/women",'files');
// }else if($catid == '5'){
//     $imagename = imageUpload("../../upload/items/kids",'files');
// }
$imagename = imageUpload("../../upload/items/$catname",'files');

$data = array(
    'items_name'     => $name,
    'items_name_ar'  => $namear,
    'items_desc'     => $desc,
    'items_desc_ar'  => $descar,
    'items_image'    => $imagename,
    'items_count'    => $count,
    'items_active'   => '1',
    'items_price'    => $price,
    'items_discount' => $discount,
    'items_date'     => $datenow,
    'items_cat'      => $catid,#
);

insertData($table,$data);