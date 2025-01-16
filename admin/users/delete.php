<?php

include '../../connect.php';

$id = filterRequest('id');

deleteData('users',"users_id = $id");