<?php
//// Paths to config files should be set in .user.ini file
//$ini = parse_ini_file("wmffl.conf");
//
//require_once "DB/DataObject.php";
//
//$options = &PEAR::getStaticProperty('DB_DataObject', 'options');
//#$config = parse_ini_file("$SCRIPT_PATH/dataobjects.ini", TRUE);
//#$config = parse_ini_file("$CONF_PATH/wmffl.conf", TRUE);
//$config = parse_ini_file("wmffl.conf", TRUE);
//$options = $config['DB_DataObject'];
//$debug = 5;
//
//// Excluding Deprecated for now because of DB_DataObject stuff
//error_reporting(E_ALL & ~E_DEPRECATED);
//
//// DB_DataObject::debugLevel($debug);
//
//// TODO: This is a very bad thing to do, but currently I'm dependant on it because of old php behavior
//foreach ($_REQUEST as $key => $val) {
//    $$key = $val;
//}