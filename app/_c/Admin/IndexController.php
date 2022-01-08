<?php

namespace M5\Controllers\Admin;

use M5\Library\Pen;
use M5\Library\Hash;
use M5\Library\Page;
use M5\Library\Clean;
use M5\Library\Session;
use M5\Library\MySqlClass;
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

		$data = [];

		$data['title'] = s('g.admin');

		$failedPage = ADMIN_PREFIX . '#error=1';
		$successPage = ADMIN_PREFIX . '/home';

		if ($_POST['loginBtn']) {
			// pa($_POST,1);

			$username = Clean::sqlInjection($_POST['username']);
			$pass     = Clean::sqlInjection($_POST['password']);
			$password = Hash::MD5($pass);

			// pa([$username, $pass]);
			if (!$username || !$pass) {
				Session::set('msg', Pen::msg('حقول الاسم وكلمة المرور الصلاحيات لايمكن ان تكون خاليه'));
				Page::location($failedPage);
				exit();
			}

			$cond = " (admin.user = '$username' && admin.pass = '$password') ";
			// pa([$cond], 1);

			$dirver = new MySqlClass();
			if ($admin = $dirver->select("SELECT * FROM  `admin` WHERE $cond LIMIT 1")) {
				// pa($admin);
				Session::set('auth', $admin[0]);
				Page::location($successPage);
				return null;
			} else {
				Session::set('msg', Pen::msg('البيانات التي ادخلتها غير صحيحة'));
				Page::location($failedPage);
				exit();
			}

			//try to login
		}

		$widgets =  [
			'jsFile' => 'layouts.master._js',
		];

		return view(ADMIN_PREFIX . '.login-page', $data, $widgets);
	}
}
