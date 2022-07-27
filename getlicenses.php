<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
	$do  = $_POST["do"]; 
	$optionid  = $_POST["option"]; 
	$datatable = $_POST['datatable'];
	$hiddenKey = $_POST['hiddenKey'];
	$option = checkoptions($do,$optionid);
	if (isset($_POST["page"])) 
	{ 
	$page  = $_POST["page"]; 
	} 
	else 
	{ 
	$page=1; 
	}
	if($page == 0 || $page == ""){
		$page = 1;
	}
	$results_per_page = 20;
	$start_from = ($page-1) * $results_per_page;

if($hiddenKey == HIDDENKEY){
$query="select * from ".$DBPREFIX.$datatable." ".$option." order by id desc,prodID desc limit ".$start_from.", ".$results_per_page;
$sockets = db::getInstance()->get_licenses_results($query);
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
			
			$multiuserArray = db::getInstance()->get_result("select * from ".$DBPREFIX."multiusers WHERE license = ".$sockets[$i][3]);
			if($multiuserArray == null){
            	$multiuserCount = 0;
            }else{
            	$multiuserCount = count($multiuserArray);
            }
			
			//print_r($productArray);
			echo $sockets[$i][0].';'.$productArray['product'].';'.$username.';'.$sockets[$i][3].';'.$sockets[$i][4].';'.$sockets[$i][5].';'.$multiuserCount;
    			if($numresults == $j){
    			}else{
    			echo ";";
    			}
			$j++;
			}
}
			
	function checkoptions($Thisdo,$Thisoptionid){
	if($Thisdo == "userLicense"){
		if($Thisoptionid){
			$option = "WHERE uid = ".$Thisoptionid;
		}else{
		$option = "";
		}
	}else if($Thisdo == "productLicenses"){
		if($Thisoptionid){
			$option = "WHERE prodID = ".$Thisoptionid;
		}else{
		$option = "";
		}
	}
	
	return $option;
	}
?>