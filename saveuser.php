<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');

$UserName = cleanstringup($_POST['UserName']);
$EmailAddress = cleanstringup($_POST['EmailAddress']);
$Password = $_POST['Password'];
$UserActive = $_POST['UserActive'];
	$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="insert into `".$DBPREFIX."user` (username, password, email, active) values('".$UserName."','".$Password."','".$EmailAddress."',".$UserActive.")";
$wisherID = db::getInstance()->dbquery($query);
}

function cleanstringup($value){
$string = str_replace("'","&#39;",$value);
$string = str_replace("\"","&quot;",$string);
return $string;
}
?>