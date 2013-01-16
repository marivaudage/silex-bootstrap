<?php
// commen test
$config = array();

$config['debug'] = true;

$config['db.options'] = array(
  	'dbname'   	=> 'DB_NAME',
  	'user'   		=> 'LOCAL_USER',
  	'password'  => 'LOCAL_PASSWORD',
  	'host'   		=> 'localhost',
  	'driver'   	=> 'pdo_mysql',
		'charset'		=> 'utf8',
  );
  
return $config;
