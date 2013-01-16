<?php
// commen test
$config = array();

$config['debug'] = true;

$config['db.options'] = array(
    'dbname'    => 'DB_NAME',
    'user'      => 'DEV_USER',
    'password'  => 'DEV_PASSWORD',
    'host'      => 'localhost',
    'driver'    => 'pdo_mysql',
    'charset'   => 'utf8',
  );
  
return $config;
