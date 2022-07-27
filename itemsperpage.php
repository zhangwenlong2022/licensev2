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

	if (isset($_POST["page"])) { 
	$page = $_POST["page"]; 
	} 
	else 
	{ 
	$page=1; 
	}
	if($page == 0 || $page == ""){
		$page = 1;
	}
if($hiddenKey == HIDDENKEY){
	$results_per_page = 20;
	$start_from = ($page-1) * $results_per_page;

$query="select COUNT(id) AS total from ".$DBPREFIX.$datatable." ".$option;
$sockets = db::getInstance()->get_result($query);
	
		$total_pages = ceil($sockets["total"] / $results_per_page);
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
 			
            echo $i; 
			if($total_pages == $i){
			}else{
			echo ";";
			}
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