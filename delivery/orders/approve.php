<?php

include '../../connect.php';

$orderid = filterRequest('ordersid');
$userid = filterRequest('usersid');
$deliveryid = filterRequest('deliveryid');

$data = array(
    'orders_status' => 3,
    'orders_delivery' => $deliveryid
);

$count = updateData('orders',$data,"orders_id = $orderid AND orders_status = 2",false);

if ($count > 0) {
    insertNotify($userid ,'success','Your order is on the way',"users$userid",'none','refreshOrderPending');

    sendGCM('Attention!',"The order has been approved by delivery $deliveryid","admin",'none','none');
    sendGCM('Attention!',"The order has been approved by delivery " . $deliveryid,"delivery",'none','none');
  
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}
