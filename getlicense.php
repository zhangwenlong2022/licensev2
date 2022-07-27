<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
	$lid = $_POST["lID"];
	$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="select * from ".$DBPREFIX."licenses WHERE id = ".$lid." limit 1";
$sockets = db::getInstance()->get_license_result($query);
if($sockets == null){
			$numresults = 0;
}else{
			$numresults = count($sockets);
}
			$j = 1;
			for($i = 0; $i < $numresults; $i++){
			$productArray = db::getInstance()->get_result("select * from ".$DBPREFIX."products WHERE id = ".$sockets[$i][1]." LIMIT 1");
			if($sockets[$i][2] == 0){
				$username = "Not Used";
			}else{
			$userArray = db::getInstance()->get_result("select * from ".$DBPREFIX."user WHERE id = ".$sockets[$i][2]." LIMIT 1");
				$username = $userArray['username'];
			}
			//print_r($productArray);
			echo $sockets[$i][0].';'.$productArray['product'].';'.$username.';'.$sockets[$i][3].';'.$sockets[$i][4].';'.$sockets[$i][2].';'.$sockets[$i][5].';'.$sockets[$i][6].';'.$sockets[$i][7].';'.$sockets[$i][8].';'.$sockets[$i][9].';'.$sockets[$i][10].';'.$sockets[$i][11];
			if($numresults == $j){
			}else{
			echo ";";
			}
			$j++;
			}
}
?>