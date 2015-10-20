<?php
$dbhost = 'localhost';
$dbuser = 'hvinfo_user';
$dbpass = 'mad43river';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
$dbname = 'hvinfotek_db';
mysql_select_db($dbname);
?>
