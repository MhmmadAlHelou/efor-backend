<?php

 include '../connect.php';

 $usersid = filterRequest('usersid');
 $itemsid = filterRequest('itemsid');

 $count = getData("cart","cart_itemsid = $itemsid AND cart_usersid = $usersid AND cart_orders = 0",null,false);

 $data = array(
      'cart_itemsid'=> $itemsid,
      'cart_usersid'=> $usersid
  );

 insertData('cart',$data);


