<?php

include '../../connect.php';

$id = filterRequest('id');
$type = filterRequest('type');

$data = array(
    'users_type' => $type,
);

updateData('users',$data,"users_id = $id");