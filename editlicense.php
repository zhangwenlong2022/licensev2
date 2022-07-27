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
$usertID = $_POST["usertID"];
$LicensCode = $_POST["LicensCode"];
$LicenseActive = $_POST['LicenseActive'];
$LicenseSubStart = $_POST['LicenseSubStart'];
$LicenseSubEnd = $_POST['LicenseSubEnd'];
$LicenseIsSub = $_POST['LicenseIsSub'];
$isMultiUser = $_POST['LicenseMultiUser'];
$LicenseSubType = $_POST['LicenseSubType'];
$LicenseSubCheckedDate = $_POST['LicenseSubCheckedDate'];
$MaxMultiUser = $_POST['MaxMultiUser'];
$hiddenKey = $_POST['hiddenKey'];
	
if($hiddenKey == HIDDENKEY){
$query = array();

$query[0]="UPDATE `".$DBPREFIX."licenses` SET `uid` = ".$usertID." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[1]="UPDATE `".$DBPREFIX."licenses` SET `license` = '".$LicensCode."' WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[2]="UPDATE `".$DBPREFIX."licenses` SET `active` = ".$LicenseActive." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[3]="UPDATE `".$DBPREFIX."licenses` SET `isSub` = ".$LicenseIsSub." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[4]="UPDATE `".$DBPREFIX."licenses` SET `SubT` = ".$LicenseSubType." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[5]="UPDATE `".$DBPREFIX."licenses` SET `startDate` = ".$LicenseSubStart." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[6]="UPDATE `".$DBPREFIX."licenses` SET `endDate` = ".$LicenseSubEnd." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[7]="UPDATE `".$DBPREFIX."licenses` SET `lastChecked` = ".$LicenseSubCheckedDate." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[8]="UPDATE `".$DBPREFIX."licenses` SET `isMultiUser` = ".$isMultiUser." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;
$query[9]="UPDATE `".$DBPREFIX."licenses` SET `MaxMultiUser` = ".$MaxMultiUser." WHERE `".$DBPREFIX."licenses`.`id` = ".$lID;

for($i = 0; $i < count($query); $i++){
db::getInstance()->dbquery($query[$i]);
}

}
?>