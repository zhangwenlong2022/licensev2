<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
$prodID = $_POST["prodid"];
$hiddenKey = $_POST['hiddenKey'];
	
if($hiddenKey == HIDDENKEY){
$query="DELETE FROM `".$DBPREFIX."products` WHERE `id` = ".$prodID;
$result = db::getInstance()->dbquery($query);
$querya="DELETE FROM `".$DBPREFIX."licenses` WHERE `prodID` = ".$prodID;
$resulta = db::getInstance()->dbquery($querya);
}

?>