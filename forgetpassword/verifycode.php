<?php

include '../connect.php';

$email = filterRequest('email');
$verfiy = filterRequest('verfiycode');

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = '$email' AND users_verfiycode = '$verfiy'");
$stmt->execute();

$count = $stmt->rowCount();

result($count);