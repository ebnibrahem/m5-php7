<?php

namespace M5\Controllers;

use M5\MVC\Controller as BaseController;

/**
 * Error handler Controller
 *
 */
class ErrorsController extends BaseController
{
	public function index()
	{
		echo "<title>404</title>";

		echo "<h4 dir=\"ltr\" style=\"font:18px tahoma;padding:10px;background-color:#FFCCBC;color:#272727\"> <u> </u>404! " . $_SERVER['REQUEST_URI'] . " </h4>";

		// $url = $_SERVER['REQUEST_URI'];
		// $app_args = array(
		// 	"url"    => $url,
		// 	"status" => 1,
		// );
		// \M5\MVC\APP::play($app_args);

		echo pre("<a href='" . url() . "'>Home</a> |" . "<a href='" . url('sole.php') . "'>Sole</a> ");
		die();
	}
}
