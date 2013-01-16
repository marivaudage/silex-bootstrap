<?php
// commen test
$config = array();

$config['debug'] = false;

$config['db.options'] = array(
    'dbname'    => 'DB_NAME',
    'user'      => 'PROD_USER',
    'password'  => 'PROD_PASSWORD',
    'host'      => 'localhost',
    'driver'    => 'pdo_mysql',
    'charset'   => 'utf8',
  );
  
return $config;
