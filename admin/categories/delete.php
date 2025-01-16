<?php

include '../../connect.php';

$id = filterRequest('id');
$imagename = filterRequest('imagename');
$catname = filterRequest('catname');//

if(is_dir("../../upload/items/$catname")){
    $foldercontent = scandir("../../upload/items/$catname");
    unset($foldercontent[0],$foldercontent[1]);
    foreach ($foldercontent as $key => $value) {
        $path = "../../upload/items/$catname/$value";
        unlink($path);
        // echo filetype($dirpath).'<br/>';
        // echo $value.'<br/>';
    }
    // print_r($foldercontent);
    rmdir("../../upload/items/$catname");
    // echo 'deleted';
}

deleteFile("../../upload/categories",$imagename);

deleteData('categories',"categories_id = $id");