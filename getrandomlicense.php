<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
	$pID = $_POST["pID"];
	$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="select * from ".$DBPREFIX."licenses WHERE `prodID` = ".$pID." AND `active` = 0 ORDER BY RAND() limit 1";
$sockets = db::getInstance()->get_license_result($query);
			$numresults = count($sockets);
			$j = 1;
			for($i = 0; $i < count($sockets); $i++){
			//print_r($productArray);
			echo $sockets[$i][0].';'.$sockets[$i][3];
			if($numresults == $j){
			}else{
			echo ";";
			}
			$j++;
			}
}
?>