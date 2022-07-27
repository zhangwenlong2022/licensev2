<?php

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');

$productID = $_POST['productID'];
$licensekey = $_POST['licensekey'];
$numberSegments = $_POST['numberSegments'];
$numberSegChars = $_POST['numberSegChars'];
$hiddenKey = $_POST['hiddenKey'];
$suffix = null;

if($hiddenKey == HIDDENKEY){
	
	$querya="select * from ".$DBPREFIX."products WHERE id = ".$productID." limit 1";
	$sockets = db::getInstance()->get_product_results($querya);
	$numresults = count($sockets);
		
	if($numresults > 0){
	$query="INSERT INTO `".$DBPREFIX."licenses` (`id`, `prodID`, `uid`, `license`, `active`, `isSub`, `SubT`, `startDate`, `endDate`, `lastChecked`, `isMultiUser`, `MaxMultiUser`) values(NULL, ".$productID.", 0, '".$licensekey."', 0,".$sockets[0][4].",".$sockets[0][5].", 0, 0, 0, 0, 0)";
	$wisherID = db::getInstance()->dbquery($query);
		echo $wisherID;
	}
}else{
		echo "servererror";
}
?>