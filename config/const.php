<?php 



//set default time

date_default_timezone_set("Africa/Lagos");



session::init();



//Session life time 1 month

ini_set("session.gc_maxlifetime", 60 * 60 * 24 * 31);



//define("URL", "http://localhost/new");
define("URL", "http://localhost/eric");
define("APP_NAME", "SwissFunding");



// database

define("DBTYPE", "mysql");

define("DBHOST", "localhost:3306");

define('DBNAME', 'pay');
//define("DBNAME", "cash");

define("DBUSERNAME", "root");
//define("DBUSERNAME", "root");

define("DBPASS", "E@321_use");
//define("DBPASS", "nkem");







?>