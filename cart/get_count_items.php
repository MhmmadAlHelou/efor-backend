<?php

include '../connect.php';

$usersid = filterRequest('usersid');
$itemsid = filterRequest('itemsid');

$stms = $con->prepare("SELECT COUNT(cart.cart_id) AS countitems FROM `cart` WHERE cart_usersid = $usersid AND cart_itemsid = $itemsid AND cart_orders = 0");
$stms->execute();

$count = $stms->rowCount();

$data = $stms->fetchColumn();

if($count > 0){
    echo json_encode(array('status'=>'success', 'data'=>$data));
}else{
    echo json_encode(array('status'=>'success', 'data'=>'0'));
}

?>