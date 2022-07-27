<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
include('sitesettings.php');
$DBPREFIX = db::getInstance()->prefix;
	$prodID = $_POST["pid"];
	$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="select * from ".$DBPREFIX."products WHERE id = ".$prodID." limit 1";
$sockets = db::getInstance()->get_product_results($query);
			$numresults = count($sockets);
			$j = 1;
			for($i = 0; $i < count($sockets); $i++){
			echo $sockets[$i][1].';'.$sockets[$i][2].';'.$sockets[$i][3].';'.$sockets[$i][4].';'.$sockets[$i][5];
			if($numresults == $j){
			}else{
			echo ";";
			}
			$j++;
			}
}
?>