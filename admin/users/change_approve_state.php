<?php

include '../../connect.php';

$id = filterRequest('id');
$approve = filterRequest('approve');

$data = array(
    'users_approve' => $approve,
);

updateData('users',$data,"users_id = $id");