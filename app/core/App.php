<?php

namespace M5\MVC;


/**
 * Main MIC6 framework, Here the application will go playing.
 * Play the M5 appellation
 */
class App
{
	private function __construct()
	{
	}

	protected static   $router;
	protected static   $error = 'null';
	protected static   $notes = [];
	protected static   $showSummary;
	private   static   $E404;
	private   static   $disabled_main_app = null;
	private   static   $disabled_api_app = null;


	/**
	 * Play Application.
	 * Main run function When use auto Route without Route Controller pointer .
	 *
	 * @param  String $url As http url format
	 * @return mixed
	 */
	public static function play($url)
	{
		Self::$showSummary = is_array($url) ? $url["status"] : Self::$showSummary;
		$url = is_array($url) ? $url["url"] : $url;


		Self::$router = new Router($url);

		$all_c_dirs    =  Self::$router->GetSubDirectories();
		$language      =  Self::$router->getLanguage();
		$Directory     =  Self::$router->getDirectory();
		$controller    =  Self::$router->getController();
		$method        =  Self::$router->getMethod();
		$params        =  Self::$router->getParams();

		// pa($all_c_dirs, '0', '#fff');
		// pa($language, '0', '#c0c');
		// pa($Directory, '0', '#f00');
		// pa($controller, '0', '#0ff');
		// pa($method, '0', '#ace');
		// pa($params, '0', '#CCC');
		// die;

		Self::$notes[] = '<td style = "color:#0D0"> Last Update </td><td>[<em>05-4-2021</em> ]</td>';

		/* All sub Directories off Contollers*/
		Self::$notes[] = '<td> Sub Directories of Contollers </td><td>[<em  style = "color:#00AA00"> ' . implode(",", $all_c_dirs) . '</em>]  </td>';

		/*language strings file*/
		// $lang_file = ROOT . LANGUAGE_PREFIX . DS . $language . DS;
		// require_once $lang_file;

		if (!in_array($language, ["ar"])) {
			$GLOBALS['language_flag'] = $language;
			define('TEXT_DIRECTION_END', 'right');
		} else {
			define('TEXT_DIRECTION_END', 'left');
		}

		/*changes site URL (add prefix e.g. /en )*/
		if (Config::get("default_language") != $language) {
			Config::set("site", Config::get("site") . $language . "/");
		}

		// echo $Directory;
		$sub_folder = ($Directory) ? (trim($Directory)) . DS : '';
		$filename = C_PATH . $sub_folder . ucfirst($controller) . 'Controller.php';
		// echo
		// $filename;
		// $filename = strtolower($filename);

		// pa(C_PATH, '0', '#FFF');
		// if (!file_exists($filename)) trigger_error("<b>" . $filename . "</b> Does not exists!");

		if (!is_readable($filename)) {
			// echo "not_is_readable";
			Self::$E404 = ucfirst($controller) . 'Controller';
			$controller = Config::get("default_404_class");

			Self::$notes[] = '<td> <em style="color:#F00">Physical File </td><td> <em style="color:#F00">File does not exists | </em>' . $filename . '</td>';
			Self::$notes[] = '<td> <em><b>Default_404_class</b> </td> <td>(' . $controller . ') class is used </em>' . '</td>';
		} else {
			// echo "is_readable";
			Self::$notes[] = "<td style='color:#199'> PHP Class file  </td><td>$filename  </td>";
		}

		/*Instantiation class*/
		$dir = ($Directory != "/" && $controller != "error") ? ucfirst($Directory) . "\\" : '';
		$class_object = "\M5\Controllers\\" . $dir . ucfirst($controller) . 'Controller';

		/* Middleware checking */
		$current_dir = strtolower($Directory);
		Self::middlewareChecker($current_dir, $controller);

		/* Dispatcher */
		$dispacher_result = Self::dispacher($class_object, $method, $params);

		// pa([$class_object,$method,$params], '0', '#F00');

		/* if method not found ? call default method and Set method that's called as first parameter to it */
		if ($dispacher_result['st'] == "method_not_found") {
			// echo "method_not_found";
			$controller = new $class_object();

			if ($params[0]) {
				array_unshift($params, $method);
				$controller->{Config::get("default_method")}($params);
			} else {
				$controller->{Config::get("default_method")}($method);
			}

			//log notes
			Self::$notes[] = "<td>Default Method</td><td>" . pure_class($class_object) . "::" . Config::get("default_method") . '() <em> Default Method  used </em></td>';
			Self::$notes[] = "<td style='color:#F0c'>Set  $method() as first-params to " . Config::get("default_method") . "</td>";
		}

		/* if class not found ? call default class and Set class that's called as first parameter to default_method */
		// if($dispacher_result['st'] == "E404"){

		// }

		/* Application status*/
		Self::getAppSt();
	}

	/**
	 * Check are Threre Access Rules to current sub Directory.
	 * this work as Middleware Mechanism.
	 *
	 * @return void
	 */
	private static function middlewareChecker($current_dir, $controller)
	{
		$rules_list = Config::get("RouterAccessRules");

		// pa($rules_list);
		/* 1. Check if current_dir has been Added to $rules_list['directories'] */
		if (in_array($current_dir, $rules_list['directories'])) {
			Self::$notes[] = '<td style = "color:#0000FF"> Middleware</td><td  style = "color:#0000FF">There are  access rules to [<em>' . $current_dir . '</em>] Directory. </td>';

			/* 1.1. Get Rules of  $current_dir */
			$rules_current_dir = $rules_list['rules'][$current_dir];

			$omitted_class_from_rules = $rules_list['rules'][$current_dir]['omitted_class'];
			$rules_upon_current_dir   = $rules_list['rules'][$current_dir]['access_rule'];

			// ve($rules_upon_current_dir);

			/*1.2. Check if current Contoller are [omiited] exceptioned*/
			$current_controller = strtolower($controller);

			if (@in_array($current_controller, $omitted_class_from_rules)) {
				Self::$notes[] = '<td  style = "color:#0000FF"> Omitted Class?</td><td style = "color:#0000FF">This class <em>[' . $controller . ']</em> are Omitted from Access rules execution </td>';
			} else {
				//* You can call more closure call_user_func_array() */
				call_user_func($rules_upon_current_dir);
			}
		} else {

			Self::$notes[] = ' <td style = "color:#0000FF"> Middleware </td><td  style = "color:#0000FF"> No access rules to <em>' . $current_dir . '/</em> Directory.</td>';
		}
		return null;
	}

	/**
	 * Get router method
	 *
	 * @return object;
	 */
	public static function getRouter()
	{
		return
			Self::$router;
	}


	/**
	 * Calling method | call default method if does not exists.
	 * @version v1.1 Supported PHP7
	 *
	 *  @return mixed
	 */
	protected static function dispacher($class, $method = '', $params = '')
	{
		// pa(func_get_args());
		$class = str_replace('\\\\', "\\", $class); //trim double //

		if (!class_exists($class)) {
			echo "<td>Oops! <u  style='color:#F00'>" . strtoupper(pure_class($class)) . "</u></td><td> Class Does Not Instantiated ! Check composer/autoload_classmap.php </td><br />";
			return 0;
		} else {
			Self::$notes[] = "<td style='color:#199'> Class </td><td>$class  </td>";
		}

		$controller = new $class();

		/* if class not found ? call default_404_class and Set class that's called as first parameter to default_method */
		if (Self::$E404) {
			$param = strtolower(Self::$E404);
			$controller = new $class;
			$controller->index([$param]);
			Self::$notes[] = "<td style='color:#Ff9900'>Alternative Method</td><td style='color:#Ff9900'> <u>" . $class . "::" . $method . "($param)" . "</u></td>";
			return ["st" => "E404"];
		}

		if (!method_exists($controller, $method)) {
			Self::$notes[] = "<td style='color:#Ff9900'>Method</td><td style='color:#Ff9900'>Oops! <u>" . $class . "::" . $method . "()" . "</u> Method not found</td>";
			return [
				"st" => "method_not_found",
			];
		} else {
			if ($params[2]) {
				$controller->$method($params[0], $params[1], $params[2]);
				Self::$notes[] = "<td style='color:#F0c'> Call <em> " . pure_class($class) . ":: $method </em> With 3 params.</td>";
			} elseif ($params[1]) {
				$controller->$method($params[0], $params[1]);
				Self::$notes[] = "<td style='color:#F0c'> Call <em> " . pure_class($class) . ":: $method </em> With 2 params.</td>";
			} elseif ($params[0]) {
				$controller->$method($params[0]);
				Self::$notes[] = "<td style='color:#F0c'> Call <em> " . pure_class($class) . ":: $method </em> With 1 params.</td>";
			} else {
				$controller->$method();
				Self::$notes[] = "<td style='color:#F0c'> Call <em> " . pure_class($class) . ":: $method </em> Without params.</td>";
			}
		}
	}

	/**
	 *  Set Error notes
	 *
	 * @return boolean | string
	 */
	public static function setNote($note = '')
	{
		return Self::$notes[] = $note;
	}



	/**
	 * Get Summary of Application.
	 *
	 */
	private static function getAppSt()
	{
		if (Self::$disabled_main_app) return null;

		if (Self::$showSummary) {
			$Directory = !APP::getRouter()->getDirectory() ? C_PATH : APP::getRouter()->getDirectory();
			echo "<pre class='pa' style='text-align:left;font-family:\"fira code\",consolas;direction:ltr;font-size:.8em;background:#f6f5f8;color:#272120'>";
			echo "<h2>Summary: </h2>";
			print("<b> REQUEST URL : </b> " . APP::getRouter()->getUrl() . "<br />");
			print("<b> Directory: </b> " . $Directory . "<br />");
			print("<b> Language: </b> " . APP::getRouter()->getLanguage() . "<br />");
			print("<b> Controller: </b> " . APP::getRouter()->getController() . "<br />");
			print("<b> Method: </b> " . APP::getRouter()->getMethod() . "<br />");

			if ($parms = APP::getRouter()->getParams()) {
				print("<b> parameters: </b> ");
				foreach ($parms as $key => $prm) {
					echo "" . $prm . ", ";
				}
				echo "<br>";
			} else
				print("<b> parameters: </b> null ");

			if (Self::$notes) {
				echo "<hr> <b> * Notes</b>: <table border=1>";
				foreach (Self::$notes as $key => $note) {
					echo "<tr> ";
					echo  $note;
					echo "</tr> ";
				}
				echo "</table>";
				echo "</pre>";
			}
		}
	}


	/**
	 * RESTfull approach in running application
	 *
	 */
	public static function API($url)
	{
		Self::$disabled_main_app = true;
		// pa($url);
		Self::$showSummary = is_array($url) ? $url["status"] : Self::$showSummary;

		require_once 'app/routes.php';
		Route::play(Self::$showSummary);
	}
}
