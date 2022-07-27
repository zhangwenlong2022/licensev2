<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// Send variables for the MySQL database class.
//Change User,PW and yourDBname

require 'db.php';
//$prefix = PREFIX;
$DBPREFIX = db::getInstance()->prefix;

$query = array();
$query[0]="CREATE TABLE `".$DBPREFIX."licenses` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `prodID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `license` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
);";

echo "Created licenses Table..";
$query[1]="INSERT INTO `".$DBPREFIX."licenses` (`id`, `prodID`, `uid`, `license`, `active`) VALUES
(1, 1, 0, '1Whd3uOwKhuP5v/vSUlefAXMG/eSagip', 0),
(2, 1, 0, 'L44Kpywqn/dDU+f7DSYXcq0QJBYV8xv+', 0),
(3, 1, 1, 'zBjA6NOZXbKyInDrsENBYzAaTJBqRBd3', 1),
(4, 1, 0, 'iJWT0P8FBnKNMgWJtWK8yxd+O03rgWT8', 0),
(5, 1, 0, 'Lkje20RdPlpv8Ier7wJQlsf+xWHlZr4/', 0),
(6, 2, 0, 'yGJodnNKtd5YYuNYWYw/mWXWLmNpUHCY', 0),
(7, 2, 1, 'sZvNxC4lHHmJMOiGWocz6M7HwC5DLzL6', 1),
(8, 2, 0, 'a5pRi4pkW0cWeMlwsJFW1tO1UthyC6Q7', 0),
(9, 2, 0, 'qxukc8rAQJ7ZoMEABTPMSXtEoDzjD8xt', 0),
(10, 2, 0, 'bwoabKRTScE9NOdlxW/PR5Pzjr1l55Zw', 0);";

echo "Inseted licenses into Table..";
$query[2]="CREATE TABLE `".$DBPREFIX."products` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `active` int(11) NOT NULL
);";

echo "Created products Table..";
$query[3]="INSERT INTO `".$DBPREFIX."products` (`id`, `product`, `description`, `active`) VALUES
(1, 'Product 1', 'Product 1 test.', 1),
(2, 'Product 2', 'Product 2 test', 1);";

echo "Inserted demo products into Table..";
$query[4]="CREATE TABLE `".$DBPREFIX."user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
);";

echo "Created user Table..";
$query[5]="INSERT INTO `".$DBPREFIX."user` (`id`, `username`, `password`, `email`, `active`) VALUES
(1, 'demo', '12345', 'demo@demo.com', 1);";

echo "Inserted demo users into Table..";
for($i = 0; $i < count($query); $i++){
db::getInstance()->dbquery($query[$i]);
}

include_once("upgrade_1.php");
include_once("upgrade_2.php");

?>