<?php
define('TWHOST','localhost');
define('TWUSER','username');
define('TWPASS','password');
define('TWNAME','database');
define('TWPORT','3306');

$tdb = new PDO("mysql:host=".TWHOST.";port=".TWPORT.";dbname=".TWNAME, TWUSER, TWPASS);
$tdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$tdb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//set timezone
date_default_timezone_set('America/Los_Angeles');
?>
