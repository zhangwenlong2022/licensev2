<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
$uid = $_POST["uid"];
$UserName = cleanstringup($_POST['UserName']);
$EmailAddress = cleanstringup($_POST['EmailAddress']);
$Password = $_POST['Password'];
$UserActive = $_POST['UserActive'];

$query="UPDATE `".$DBPREFIX."user` SET `username` = '".$UserName."', `password` = '".$Password."', `email` = '".$EmailAddress."', `active` = ".$UserActive." WHERE `id` = ".$uid;
$wisherID = db::getInstance()->dbquery($query);
print_r($wisherID);

function cleanstringup($value){
$string = str_replace("'","&#39;",$value);
$string = str_replace("\"","&quot;",$string);
return $string;
}
?>