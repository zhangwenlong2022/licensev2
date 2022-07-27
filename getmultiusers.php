<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
$DBPREFIX = db::getInstance()->prefix;
include('sitesettings.php');
	$hiddenKey = $_POST['hiddenKey'];
	$datatable = $_POST['datatable'];
	$lid = $_POST['option'];
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
    
    $querylicense="select * from ".$DBPREFIX."licenses WHERE id = ".$lid." limit 1";
    $licenseresult = db::getInstance()->get_license_result($querylicense);
    if($licenseresult == null){
    			echo "nouserswithlicense";
    }else{
    	$query="select * from ".$DBPREFIX.$datatable." WHERE `license` = '".$licenseresult[0][3]."' order by id desc limit ".$start_from.", ".$results_per_page;
        $sockets = db::getInstance()->get_multiuser_results($query);
        if($sockets == null){
			$numresults = 0;
        }else{
			$numresults = count($sockets);
        }
			$j = 1;
			for($i = 0; $i < $numresults; $i++){
			echo $sockets[$i][0].';'.$sockets[$i][1].';'.$sockets[$i][2].';'.$sockets[$i][3];
			if($numresults == $j){
			}else{
			echo ";";
			}
			$j++;
			}
    }
    

}
?>