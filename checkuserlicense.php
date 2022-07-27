<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname RTJY-KFDY-63FU-UM6W-CLJ3

require 'db.php';
include('sitesettings.php');
$DBPREFIX = db::getInstance()->prefix;
$productID = $_POST['productID'];
$Username = $_POST['Username'];
$Password = $_POST['UserPassword'];
$LicenseKey = $_POST['UserLicense'];
$LicenseLastChecked = $_POST['LastChecked'];
$hiddenKey = $_POST['hiddenKey'];

	$lastChecked = 0;
	$ismultiuserlicense = 0;

if($hiddenKey == HIDDENKEY){
    
    // get this license from the POSTED license key
		$licensequery="select * from ".$DBPREFIX."licenses WHERE prodID = ".$productID." AND license = '".$LicenseKey."'";
		$licensesockets = db::getInstance()->get_license_result($licensequery);
		if($licensesockets == null){
		    $licensekeynumresults = 0;
		}else{
		    $licensekeynumresults = count($licensesockets);
		}
		
		// Check how many multi users we have if within limit continue
		        $checkmultiuserquery="select * from ".$DBPREFIX."multiusers WHERE license = '".$LicenseKey."'";
            	$checkmultiuserresults = db::getInstance()->get_multiuser_result($checkmultiuserquery);
            	if($checkmultiuserresults == null){
            	    $checkmultiusernumresults = 0;
            	}else{
            	    $checkmultiusernumresults = count($checkmultiuserresults);
            	}
		
		// check if we have a license of that type
		if($checkmultiusernumresults < $licensesockets[0][11]){
    		if($licensekeynumresults > 0){
    		    // check to see if this license is a multi user license
    		    if($licensesockets[0][10] == 1){
    		        // check if this user has signed up before
    		        $checkuserquery="select * from ".$DBPREFIX."multiusers WHERE username = '".$Username."' AND password = '".$Password."' AND license = '".$LicenseKey."' limit 1";
                	$checkuserresults = db::getInstance()->get_multiuser_result($checkuserquery);
                	if($checkuserresults == null){
                	    $checkusernumresults = 0;
                	}else{
                	    $checkusernumresults = count($checkuserresults);
                	}
                	
                	// if they have not signed up before add them to the database
                	if($checkusernumresults == 0){
                        $usernumresults = 1;
                	    $uid =  $licensesockets[0][2];
                	    
                	    $adduserquery="insert into `".$DBPREFIX."multiusers` (username, password, active, license) values('".$Username."','".$Password."',1, '".$LicenseKey."')";
	                    $ismultiuserlicense = 1;
                        $adduserresult = db::getInstance()->dbquery($adduserquery);
                	}else if($checkusernumresults > 0 && $checkuserresults[0][3] == 1){
                	    // check if this multi user username and password
                        $usernumresults = 1;
                	    $uid =  $licensesockets[0][2];
	                    $ismultiuserlicense = 1;
                	}else{
            			echo "licenseinvalid;;";
            		}
    		    }else{
        		        // if its not a multi user license we go here and do are checks.
                    $querya="select * from ".$DBPREFIX."user WHERE username = '".$Username."' AND password = '".$Password."' limit 1";
                    $userresults = db::getInstance()->get_user_result($querya);
                    $usernumresults = count($userresults);
                    $uid = $userresults[0][0];
        		}
    		}else{
    			echo "licenseinvalid;;";
    		}
		}else{
    		echo "licenseinvalid;;";
    	}
		

	if($usernumresults > 0){
		$query="select * from ".$DBPREFIX."licenses WHERE prodID = ".$productID." AND uid = ".$uid." AND license = '".$LicenseKey."'";
		$sockets = db::getInstance()->get_license_result($query);
		if($sockets == null){
		    $keynumresults = 0;
		}else{
		    $keynumresults = count($sockets);
		}
	}
	if($keynumresults > 0 && $sockets[0][4] == 1){
	    if($ismultiuserlicense == 1){
	        $LicenseLastChecked = $sockets[0][9];
	    }
		if($sockets[0][5] == 1){
			if($sockets[0][7] == 0){
				$subLenght = convertsubtime($sockets[0][6]);
				$timenow = time();
				$subenddate = $timenow+$subLenght+604800;
				$lastLenght = licensechecktime($sockets[0][6]);
				$lastChecked = $timenow+$lastLenght;
				$startDate = time();
				$querya="UPDATE `".$DBPREFIX."licenses` SET `startDate` = ".$startDate.", `endDate` = ".$subenddate.", `lastChecked` = ".$lastChecked." WHERE prodID = ".$productID." AND uid = ".$uid." AND license = '".$LicenseKey."'";
				$wisheraID = db::getInstance()->dbquery($querya);
				echo "licensevalid;".$lastChecked.";".$subenddate;
			}else{
				if($LicenseLastChecked == $sockets[0][9])
				{
					$timenow = time();
					$lastLenght = licensechecktime($sockets[0][6]);
					$lastChecked = $timenow+$lastLenght;
					$querys="UPDATE `".$DBPREFIX."licenses` SET `lastChecked` = ".$lastChecked." WHERE prodID = ".$productID." AND uid = ".$uid." AND license = '".$LicenseKey."'";
					$wishersID = db::getInstance()->dbquery($querys);
					if($timenow >= $sockets[0][8]){
						echo "licenseinvalid;;";
					}else{
					echo "licensevalid;".$lastChecked.";".$sockets[0][8].";".$LicenseLastChecked.";".$sockets[0][9];
					}
				}else{
					echo "licenseinvalid;".$lastChecked.";".$sockets[0][8].";".$LicenseLastChecked.";".$sockets[0][9];
				}
			}
    	}else{
    		$timenow = time();
    		$lastLenght = licensechecktime($sockets[0][6]);
    		$lastChecked = $timenow+$lastLenght;
    		echo "licensevalid;".$lastChecked.";".$sockets[0][8].";".$LicenseLastChecked.";".$sockets[0][9];
		}
	}else  if($keynumresults > 0 && $sockets[0][4] == 1 && $sockets[0][5] == 0){
		$timenow = time();
		$lastLenght = licensechecktime($sockets[0][6]);
		$lastChecked = $timenow+$lastLenght;
		echo "licensevalid;".$lastChecked.";".$sockets[0][8].";".$LicenseLastChecked.";".$sockets[0][9];
	}else{
	    echo "licenseinvalid;;";
	}
}
function licensechecktime($days){
	$subtime = 0;
	if($days = 0){
	$subtime = 86400;
	}else if($days = 1){
	$subtime = 86400;
	}else if($days = 2){
	$subtime = 604800;
	}else if($days = 3){
	$subtime = 2629743;
	}
	return $subtime;
}

function convertsubtime($days){
	$subtime = 0;
	if($days = 0){
	$subtime = 86400;
	}else if($days = 1){
	$subtime = 604800;
	}else if($days = 2){
	$subtime = 2629743;
	}else if($days = 3){
	$subtime = 31556926;
	}
	
	return $subtime;
}

function cleanstringup($value){
	$string = str_replace("'","&#39;",$value);
	$string = str_replace("\"","&quot;",$string);
	return $string;
}
?>