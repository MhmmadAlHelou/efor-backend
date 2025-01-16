<?php

include '../../connect.php';

$id = filterRequest('id');
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

updateData('coupon',$data,"coupon_id = $id");