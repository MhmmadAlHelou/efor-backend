<?php

include '../../connect.php';

$orderid = filterRequest('ordersid');
$userid = filterRequest('usersid');
$type = filterRequest('ordertype');

if($type == '0'){
    $data = array('orders_status' => 2);
}else{
    $data = array('orders_status' => 4);
}

updateData('orders',$data,"orders_id = $orderid AND orders_status = 1");

insertNotify($userid ,'success','The order has been approved',"users$userid",'none','refreshOrderPending');

if($type == '0'){
    sendGCM('Attention!','There is an order watting approval','delivery','none','none');
}