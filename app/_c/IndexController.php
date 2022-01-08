<?php

namespace M5\Controllers;

use M5\Models\Application;
use M5\MVC\Controller as BaseController;

class IndexController extends BaseController
{

	function __construct()
	{
		Parent::__construct();
	}

	/**
	 * entry point
	 *
	 * @return mixed
	 */
	function index()
	{
		$data['courses'] = $courses;

		$widgets =  [
			// 'before' => 'layouts.master._header',
			// 'after'  => 'layouts.master._footer',
			// 'jsFile' => 'layouts.master._js-index',
		];

		return view('welcome', $data, $widgets);
	}
}
