<?php

include '../../connect.php';

$id = filterRequest('id');
$imagename = filterRequest('imagename');
$catname = filterRequest('catname');

// if($catid == '1'){
//     deleteFile("../../upload/items/men",$imagename);
// }else if($catid == '2'){
//     deleteFile("../../upload/items/women",$imagename);
// }else if($catid == '5'){
//     deleteFile("../../upload/items/kids",$imagename);
// }

deleteFile("../../upload/items/$catname",$imagename);

deleteData('items',"items_id = $id");