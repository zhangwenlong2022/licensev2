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
$UserName = cleanstringup($_POST['UserName']);
$Password = $_POST['Password'];
$UserActive = $_POST['UserActive'];
$hiddenKey = $_POST['hiddenKey'];


if($hiddenKey == HIDDENKEY){
$query = array();

$query[0]="UPDATE `".$DBPREFIX."multiusers` SET `username` = '".$UserName."' WHERE `".$DBPREFIX."multiusers`.`id` = ".$uid;
$query[1]="UPDATE `".$DBPREFIX."multiusers` SET `password` = '".$Password."' WHERE `".$DBPREFIX."multiusers`.`id` = ".$uid;
$query[2]="UPDATE `".$DBPREFIX."multiusers` SET `active` = ".$UserActive." WHERE `".$DBPREFIX."multiusers`.`id` = ".$uid;

    for($i = 0; $i < count($query); $i++){
    db::getInstance()->dbquery($query[$i]);
    }

}

function cleanstringup($value){
$string = str_replace("'","&#39;",$value);
$string = str_replace("\"","&quot;",$string);
return $string;
}
?>