<?php

include '../../connect.php';

$couponName = filterRequest('couponname');
$couponCount = filterRequest('couponcount');
$couponDiscount = filterRequest('coupondiscount');
$couponExpireDate = filterRequest('couponexpiredate');

$data = array(
    'coupon_name' => $couponName,
    'coupon_count' => $couponCount,
    'coupon_discount' => $couponDiscount,
    'coupon_expiredate' => $couponExpireDate,
);

insertData('coupon',$data);

?>