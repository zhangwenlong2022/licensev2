<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
$uID = $_POST["uID"];
	$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="DELETE FROM `".$DBPREFIX."multiusers` WHERE `id` = ".$uID;
$result = db::getInstance()->dbquery($query);
}

?>