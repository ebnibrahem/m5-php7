<?php
ob_start();
session_start();

#################################
# PHP VERSION
#################################
if (version_compare(PHP_VERSION, '5.5') < 0)
	die("<h1 align='center' style='color:red'>THIS SCRIPT NEED PHP VERSION 5.5 OR Higher.<h2 align='center'>Current Version: " . PHP_VERSION . "</h2></h1>");

if (!function_exists("mb_substr"))
	die("<h1 align='center' style='color:red'>THIS SCRIPT NEEDS to active mb_substr Functions .<h2 align='center'> </h1>");

#################################
# General Config
#################################
// ini_set('session.cookie_httponly', true);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
date_default_timezone_set("Asia/Riyadh");

$environment = preg_match('/localhost/', $_SERVER['HTTP_HOST']) ? 'localhost' : 'remote';

$host = preg_match('/localhost/', $_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['HTTP_HOST'];

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)) . DS);
define('HOST', trim($host, "/"));
define('DEV', $environment);
define('IP', $_SERVER['REMOTE_ADDR']);

/**
 * FOLDERS PREFIX
 */
define("ASSETS_PREFIX", 'public');
define("LANGUAGE_PREFIX", 'strings');
define("MODEL_PREFIX", '_m');
define("VIEW_PREFIX", '_v');
define("CONTROLLER_PREFIX", '_c');
define("ADMIN_PREFIX", 'admin');

/* Application Directories */
define("C_PATH",    ROOT . 'app' . DS . CONTROLLER_PREFIX . DS);
define("ASSETS_PATH",    ROOT . ASSETS_PREFIX . DS);
define("M_PATH",    ROOT . 'app' . DS . MODEL_PREFIX . DS);
define("V_PATH",    ROOT . 'app' . DS . VIEW_PREFIX . DS);
define("LANG_FILE", ROOT . LANGUAGE_PREFIX . DS);

define("_PATH",     ROOT . 'assets/');
define("UPLOAD_DIR", ROOT . 'upload/');
define("BACKUP_DIR", ROOT . 'backup/');
define("_WID",      V_PATH . 'widgets/');

#################################
# Timestamp
################################
define('R_DATE', date("Y-m-d"));
define('R_DATE_LONG', date("Y-m-d H:i:s"));

################################
# Application http links
################################

$_dir = dirname($_SERVER['SCRIPT_NAME']);
$link = (preg_match('/[\/|\\\]/', $_dir) == true) ? "/" : "/" . trim($_dir, "/") . "/";

$http = "http";
$http = (preg_match('/localhost/', HOST) == true) ? "http" : $http;
define("URL",       "$http://" . HOST . $link);

define("ASSETS",    URL . ASSETS_PREFIX . '/');
define('LOGO',      ASSETS . ('images/logo.png'));
define('LOADING',   ASSETS . ('images/loader.gif'));
define('NO_IMG',    ASSETS . ('images/no_image.png'));
define('COIN',    'دولار');
define('COIN_EN',    'USD');

###############################
# DEVELOPER MODE
###############################
define('DEV_MODE', 'on'); // on | no
define('CACHE_VAR', "?" . uniqid());
// define('CACHE_VAR', ""); // "?".uniqid() | no


###############################
/*Uploads File*/
###############################
if (!file_exists(UPLOAD_DIR))
	mkdir(UPLOAD_DIR);

###############################
# Composer autoloader
###############################
require_once ROOT . 'vendor/autoload.php';
