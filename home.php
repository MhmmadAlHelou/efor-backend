<?php

include 'connect.php';

$alldata = array();
$alldata['status'] = 'success';

$settings = getAllData('settings' , '1 = 1' , null , false);
$alldata['settings'] = $settings;

$categories = getAllData('categories' , null , null , false);
$alldata['categories'] = $categories;

$itemstop = getAllData('itemstopselling' , '1 = 1 ORDER BY countitems DESC' , null , false);
$alldata['itemstop'] = $itemstop;

$itemsdis = getAllData('itemstopselling' , 'items_discount != 0' , null , false);
$alldata['itemsdis'] = $itemsdis;

echo json_encode($alldata);

?>