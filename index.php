<?php

use M5\MVC\App;

require_once 'app/init.php';

$url = $_SERVER['REQUEST_URI'];

header('Access-Control-Allow-Origin : *');
header('Access-Control-Allow-Headers : Content-Type, X-Auth-Token, Authorization, Origin, Accept');
header('Access-Control-Allow-methods : GET, POST, PUT, DELETE, OPTIONS');

$app_args = array(
	"url"    => $url,
	"status" => 1,
);

// pa($app_args);

/*Running Application*/
App::play($app_args);
