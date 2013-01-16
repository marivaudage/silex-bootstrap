silex-bootstrap
===============

An empty PHP projet based on Silex, HTML5 Boilerplate and a few stuff

Install
=======
    git clone https://github.com/marivaudage/silex-bootstrap.git mysite
    cd mysite
    curl -s http://getcomposer.org/installer | php
    php composer.phar install
    mkdir cache && chmod 777 cache
    mkdir log && chmod 777 log
    
Environment
===========

Apache
	
	<VirtualHost *:80>
    	ServerName www.mysite.com
    	DocumentRoot /path/to/mysite/web
    	SetEnv APPLICATION_ENV "local"
        <Directory "/path/to/mysite/web">
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

Database : DB name, login & password to be set in config/local.php (or dev.php or prod.php)

Scripting : create the scripts/application_env.php file with the environment

	<?php
	return "local";
	
