<?php

define("MB", 1048576);

function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();

    if($where == null){
        $stmt = $con->prepare("SELECT  * FROM $table ");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    
    if($json == true){
        if ($count > 0){
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }else{
        if ($count > 0){
            return array("status" => "success", "data" => $data);
        } else {
            return array("status" => "failure");
        }
    }
}

function getData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    } 
   } else {
    return $count;
        }
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($dir,$imageRequest)
{
    global $msgError;
    if(isset($_FILES[$imageRequest])){
      $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
      $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
      $imagesize  = $_FILES[$imageRequest]['size'];
      $allowExt   = array("jpg", "jpeg", "png", "gif", "mp3", "pdf","svg");
      $strToArray = explode(".", $imagename);
      $ext        = end($strToArray);
      $ext        = strtolower($ext);
  
      if (!empty($imagename) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
      }
      if ($imagesize > 2 * MB) {
        $msgError = "size";
      }
      if (empty($msgError)) {
        move_uploaded_file($imagetmp, $dir . "/" . $imagename);
        return $imagename;
      } else {
        return "fail";
      }
    }else{
      return 'empty';
    }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "xhx" ||  $_SERVER['PHP_AUTH_PW'] != "xhx12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

}

function printFailure($message = 'none'){
    echo json_encode(array('status' => 'failure' , 'message' => $message));
}

function printSuccess($message = 'none'){
    echo json_encode(array('status' => 'success' , 'message' => $message));
}

function result($count){
    if($count > 0){
        printSuccess();
    }else{
        printFailure();
    }
}



function sendEmail($to , $title , $body){
   
    $headers = 'From: support@xhx.com'.'\n'.'cc: mhmmadxhx@gmail.com';

    mail($to,$title,$body,$headers);

    echo "Success send mail";

}

use Google\Client;
function sendGCM($title, $message, $topic, $pageid, $pagename)
{
    
    $url = 'https://fcm.googleapis.com/v1/projects/efor-e81af/messages:send';

    // include 'notification\access_token.php';
    // $accessToken = getAccessToken();
    require 'C:\xampp\htdocs\efor\vendor\autoload.php';
    $serviceAccountPath = 'C:\xampp\htdocs\efor\notification\serviceAccountPath.json';
    $client = new Client();
    $client->setAuthConfig($serviceAccountPath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->useApplicationDefaultCredentials();
    $token = $client->fetchAccessTokenWithAssertion();
    // echo $token['access_token'];
    $accessToken = $token['access_token'];

    $fields = array(
        "message" => array (
            "topic" => $topic,
            "notification" => array(
              "title" => $title,
              "body" => $message,
            ),
            "data" => array(
              "pageid" => $pageid,
              "pagename" => $pagename
            )
          )
    );
    $fields = json_encode($fields);
    
    $headers = array(
        "Authorization: Bearer $accessToken",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    
    if ($result === false) {
        throw new Exception('Curl error: ' . curl_error($ch));
    }

    return $result;
    curl_close($ch);
}

function insertNotify($userid ,$title ,$body ,$topic ,$pageid ,$pagename){
    global $con;
    $stmt = $con->prepare("INSERT INTO `notification`(`notification_userid`, `notification_title`, `notification_body`) VALUES (? , ? , ?)");
    $stmt->execute(array($userid,$title,$body));
    sendGCM($title,$body,$topic,$pageid,$pagename);
    $count = $stmt->rowCount();
    return $count;
}


