<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
$prodID = $_POST["pid"];
$prodname = cleanstringup($_POST['prodname']);
$proddescription = cleanstringup($_POST['proddescription']);
$prodactive = $_POST['prodactive'];
$prodisSub = $_POST['prodisSub'];
$prodSubT = $_POST['prodSubT'];
$hiddenKey = $_POST['hiddenKey'];

if($hiddenKey == HIDDENKEY){
$query = array();

$query[0]="UPDATE `".$DBPREFIX."products` SET `product` = '".$prodname."' WHERE `".$DBPREFIX."products`.`id` = ".$prodID;
$query[1]="UPDATE `".$DBPREFIX."products` SET `description` = '".$proddescription."' WHERE `".$DBPREFIX."products`.`id` = ".$prodID;
$query[2]="UPDATE `".$DBPREFIX."products` SET `active` = ".$prodactive." WHERE `".$DBPREFIX."products`.`id` = ".$prodID;
$query[3]="UPDATE `".$DBPREFIX."products` SET `isSub` = ".$prodisSub." WHERE `".$DBPREFIX."products`.`id` = ".$prodID;
$query[4]="UPDATE `".$DBPREFIX."products` SET `SubT` = ".$prodSubT." WHERE `".$DBPREFIX."products`.`id` = ".$prodID;
$query[5]="UPDATE `".$DBPREFIX."products` SET `active` = ".$prodactive." WHERE `".$DBPREFIX."products`.`id` = ".$prodID;

    for($i = 0; $i < count($query); $i++){
    $wisherID = db::getInstance()->dbquery($query[$i]);
    echo 'here ' . $wisherID;
    }

//$query="UPDATE `".$DBPREFIX."products` SET `product` = '".$prodname."', `description` = '".$proddescription."', `active` = ".$prodactive.", `isSub` = ".$prodisSub.", `SubT` = ".$prodSubT." WHERE `id` = ".$prodID;
//$wisherID = db::getInstance()->dbquery($query);
//		$queryb="UPDATE `".$DBPREFIX."licenses` SET `isSub`=".$prodisSub.",`SubT`=".$prodSubT." WHERE `prodID` = ".$prodID."";
//		db::getInstance()->dbquery($queryb);
//print_r($wisherID);
}


function cleanstringup($value){
$string = str_replace("'","&#39;",$value);
$string = str_replace("\"","&quot;",$string);
return $string;
}
?>