<?php

include '../../connect.php';

$orderid = filterRequest('ordersid');
$userid = filterRequest('usersid');

$data = array('orders_status' => 4);

updateData('orders',$data,"orders_id = $orderid AND orders_status = 3");

insertNotify($userid ,'success','Your order has been deliverd',"users$userid",'none','refreshOrderPending');

sendGCM('Attention!','The order has been deliverd to the customer',"admin",'none','none');