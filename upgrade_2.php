<?php
$DBPREFIX = db::getInstance()->prefix;
$querya = array();
$querya[0]="ALTER TABLE `".$DBPREFIX."licenses` ADD `isMultiUser` INT NOT NULL";
$querya[1]="ALTER TABLE `".$DBPREFIX."licenses` ADD `MaxMultiUser` INT NOT NULL";
$querya[2]="CREATE TABLE IF NOT EXISTS `".$DBPREFIX."multiusers` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `active` int(11) NOT NULL,
  `license` varchar(255) NOT NULL
);";

echo "Completed upgrade 2..";
for($i = 0; $i < count($querya); $i++){
db::getInstance()->dbquery($querya[$i]);
}

?>