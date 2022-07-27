<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
	$lid  = $_POST["lid"]; 
	$datatable = $_POST['datatable'];
	$hiddenKey = $_POST['hiddenKey'];

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
	
$licenseArray = db::getInstance()->get_result("select * from ".$DBPREFIX."licenses WHERE id = ".$lid." limit 1");

	$option = "WHERE license = '".$licenseArray['license']."'";
$query="select COUNT(license) AS total from ".$DBPREFIX.$datatable." ".$option;
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
	
?>