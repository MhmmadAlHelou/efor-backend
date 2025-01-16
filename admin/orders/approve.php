<?php

include '../../connect.php';

$orderid = filterRequest('ordersid');
$userid = filterRequest('usersid');

$data = array('orders_status' => 1);

updateData('orders',$data,"orders_id = $orderid AND orders_status = 0");

// sendGCM('success','The order has been approved',"users$userid",'none','refreshOrderPending');

insertNotify($userid ,'success','The order has been approved',"users$userid",'none','refreshOrderPending');