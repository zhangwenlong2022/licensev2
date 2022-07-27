<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
$uid = $_POST["uid"];
$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query="select * from ".$DBPREFIX."user WHERE id = ".$uid." limit 1";
$sockets = db::getInstance()->get_user_result($query);
			$numresults = count($sockets);
			$j = 1;
			for($i = 0; $i < count($sockets); $i++){
			echo $sockets[$i][0].';'.$sockets[$i][1].';'.$sockets[$i][2].';'.$sockets[$i][3].';'.$sockets[$i][4];
			if($numresults == $j){
			}else{
			echo ";";
			}
			$j++;
			}
}else{
		echo "servererror";
}
?>