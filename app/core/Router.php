<?php

namespace M5\MVC;

use M5\MVC\Config;

/**
 * 	Transforming URL.
 * 	Router of Controllers
 * 	prepare all url parts
 */
class Router
{
	private static $url;
	private static $SubDirectories;
	private static $Directory;
	private static $controller;
	private static $method;
	private static $params;
	private static $language;


	/**
	 * Parsing url.
	 *
	 */
	public function __construct($url = '')
	{
		/* Specified URL */
		Self::$url = !$url ? "/" : $url;

		$url = trim($url, "/");
		$url = rtrim($url, "/");
		$url = rtrim($url, "'");
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url_parts = (array) explode("/", $url);

		// pa($url_parts);
		Self::$SubDirectories =  Config::get("directory");

		$url_parts_language = strtolower($url_parts[0]);

		/* Specified languages */
		// pa(Config::get("languages"));
		if (in_array($url_parts_language, Config::get("languages"))) {
			$lang_file = $url_parts_language;
			$lang_file_created = (file_exists(LANG_FILE . $lang_file)) ? "1" : "0";

			array_shift($url_parts);
		}

		Self::$language = !$lang_file_created ? Config::get("default_language") : $lang_file;

		/* Specified Controller inside child Directory  */
		$Directory  = Config::get("directory")[0] . "/";
		if (in_array(strtolower($url_parts[0]), Config::get("directory"))) {
			$Directory = $url_parts[0];
			array_shift($url_parts);
		}
		Self::$Directory = $Directory;

		/* Specified Controller */
		$controller  = Self::parseController($url_parts[0]);
		if (!$url_parts[0]) {
			$controller = Config::get("default_controller");
		} else {
			array_shift($url_parts);
		}
		Self::$controller = ucfirst($controller);
		// pa($controller, '0', '#39F');


		/* Specified Methods */
		$method = !$url_parts[0] ? Config::get("default_method") : $url_parts[0];
		Self::$method = strtolower($method);
		// pa($url_parts, '0', '#299');

		$url_parts[0] ? array_shift($url_parts) : '';
		/* Specified parameters */
		$params =  $url_parts;
		// pa($params, '0', '#299');

		Self::$params = $params;
	}


	public static function getUrl()
	{
		return Self::$url;
	}

	public static function GetSubDirectories()
	{
		return Self::$SubDirectories;
	}

	public static function getDirectory()
	{
		return Self::$Directory;
	}

	public static function getController($with_dir = false)
	{
		$if_contoroller_inside_dir = (Self::$Directory == "/") ? "" : Self::$Directory . "/";
		return $with_dir ? $if_contoroller_inside_dir . Self::$controller : Self::$controller;
	}

	public static function getMethod()
	{
		return Self::$method;
	}

	public static function getParams()
	{
		return Self::$params;
	}

	public static function getLanguage()
	{
		return Self::$language;
	}

	/**
	 * [redirect description]
	 *
	 * @param  string $path page url.
	 * @return response
	 */
	public static function redirect($path = null, $die = null)
	{

		if (!$path) {
			header('location:' . Config::get('site'));
		} else {
			header('location:' . $path);
		}

		if ($die) {
			die();
		}
	}

	/**
	 * pasring controller namespace
	 *
	 * @return string;
	 */

	public static function parseController($name)
	{
		//remove ?
		if (preg_match('/\?/', $name) == true) {
			$name = explode("?", $name);
			return $name[0];
		}

		return $name;
	}
}
