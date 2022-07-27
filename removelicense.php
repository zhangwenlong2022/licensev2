<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
$lID = $_POST["lID"];
$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$querya="DELETE FROM `".$DBPREFIX."licenses` WHERE `id` = ".$lID;
$resulta = db::getInstance()->dbquery($querya);
}

?>