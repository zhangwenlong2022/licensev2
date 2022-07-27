<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;

$prodname = cleanstringup($_POST['prodname']);
$proddescription = cleanstringup($_POST['proddescription']);
$prodactive = $_POST['prodactive'];
$prodisSub = $_POST['prodisSub'];
$prodSubT = $_POST['prodSubT'];

$query="insert into `".$DBPREFIX."products` (product, description, active, isSub, SubT) values('".$prodname."','".$proddescription."',".$prodactive.",".$prodisSub.",".$prodSubT.")";
$wisherID = db::getInstance()->dbquery($query);

function cleanstringup($value){
$string = str_replace("'","&#39;",$value);
$string = str_replace("\"","&quot;",$string);
return $string;
}
		//$result = @mysqli_query($db,"SELECT * FROM jobs WHERE type='".$type."'");
	
    		//echo "Chest Of Drawers;Microwave;Cooker;Fridge;Sofa Bed;Boiler;Hot Water;Leak;Leaking;Radiator;Electric;Smoke Alarm";
?>