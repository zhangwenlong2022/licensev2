<?php
$DBPREFIX = db::getInstance()->prefix;
$querya = array();
$querya[0]="ALTER TABLE `".$DBPREFIX."licenses` ADD `isSub` INT NOT NULL";

$querya[1]="ALTER TABLE `".$DBPREFIX."licenses` ADD `SubT` INT NOT NULL";

$querya[2]="ALTER TABLE `".$DBPREFIX."licenses` ADD `startDate` INT NOT NULL";

$querya[3]="ALTER TABLE `".$DBPREFIX."licenses` ADD `endDate` INT NOT NULL";

$querya[4]="ALTER TABLE `".$DBPREFIX."licenses` ADD `lastChecked` INT NOT NULL";

$querya[5]="ALTER TABLE `".$DBPREFIX."products` ADD `isSub` INT NOT NULL";

$querya[6]="ALTER TABLE `".$DBPREFIX."products` ADD `SubT` INT NOT NULL";

echo "Completed upgrade 1..";
for($i = 0; $i < count($querya); $i++){
db::getInstance()->dbquery($querya[$i]);
}

?>