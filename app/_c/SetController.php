<?php

namespace M5\Controllers;

use M5\MVC\App;
use M5\MVC\Controller as BaseController;

use M5\MVC\Config;
use M5\Library\Page;
use M5\Library\Session;
use M5\Library\Hash;
use M5\Library\Schema;

/*use M5\Models\set_model;*/
use M5\MVC\Model;

class SetController
{
	private $class_label = "setup";
	private $db;



	function __construct()
	{
		$db = Model::getInst("tree", "show error");
		$this->db = $db;

		/* INSERT DEFAULT ROOT USER */
		$r_admin = $db->table(['tbl' => "users"])->fetch(['prINTQuery' => 0, 'index' => 'first']);

		if ($r_admin) {
			die("installed!");
		}
	}


	/** * Main Function */
	public function index()
	{

		$this->setup();
	}

	/* Sql Injection DB */
	private function setup()
	{
		// $db = Model::getInst("tree","show error");
		$db = $this->db;

		#users
		if ($db->query("
			CREATE TABLE IF NOT EXISTS `users` (
			`ID` INT PRIMARY KEY AUTO_INCREMENT,
			`BETA` VARCHAR(64),
			`is_admin` TINYINT  default 0 ,
			`name` VARCHAR( 225 ) ,
			`user` VARCHAR( 225 ) ,
			`pass` VARCHAR( 225 ) ,
			`email` VARCHAR( 225 ) ,
			`tel` VARCHAR( 225 ) ,
			`country` VARCHAR( 225 ) ,
			`ip` VARCHAR( 225 ) ,
			`about` VARCHAR( 225 ) ,
			`c_at` VARCHAR(20),
			`u_at` VARCHAR(20) ,
			`st`  INT
		)"))
			echo '<div># users created<br /></div>';
		else echo '<div>(!) users table error : ' . $db->getError() . ' ;<br /></div>';

		$seed_args = ["name" => site_name, "user" => "admin", "is_admin" => 1, "pass" => Hash::MD5("1234")];

		/* INSERT DEFAULT ROOT USER */
		$cond = " && ( user = 'admin' )";
		$r_admin = $db->table(['tbl' => "users"])->where($cond)->fetch(['prINTQuery' => 0, 'index' => 'first']);

		!$r_admin  ? $db->insert($seed_args, "users") : '';

		#role lists
		if ($db->query("CREATE TABLE IF NOT EXISTS roles(
			ID INT AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(20) ,
			alias VARCHAR(100)
		)"))
			echo "<div># Roles table created!</div>";
		else
			echo "<div>!) Roles table error : " . $db->getError() . "</div>";

		#passport to users
		if ($db->query("CREATE TABLE IF NOT EXISTS passport(
			ID       INT AUTO_INCREMENT PRIMARY KEY,
			admin_id VARCHAR(20) ,
			role_id  VARCHAR(20)
		)"))
			echo "<div># passport table created!</div>";
		else
			echo "<div>!) passport table error : " . $db->getError() . "</div>";


		#Tree categories
		if ($db->query("
			CREATE TABLE IF NOT EXISTS tree(
			ID       INT AUTO_INCREMENT PRIMARY key,
			type     VARCHAR(100) DEFAULT 'part',
			name     VARCHAR(200),
			_desc    longtext,
			rank     VARCHAR(100) default 'parent' ,
			parent   VARCHAR(100) default '0',
			ava      VARCHAR(100),
			st       INT DEFAULT 1,
			BETA     VARCHAR(32),
			`c_at`   VARCHAR( 100 ),
			`u_at`   VARCHAR( 100 )

		)"))

			echo '<div># Tree created<br /></div>';
		else echo '<div>(!) Tree table error : ' . $db->getError() . ' ;<br /></div>';

		# MIC-applicaiotn information
		if ($db->query("
			CREATE TABLE  IF NOT EXISTS mic(
			`ID`          INT PRIMARY KEY AUTO_INCREMENT,
			`name`        VARCHAR(200) ,
			`description` longtext ,
			`keywords`    longtext ,
			`email`       VARCHAR(200) ,
			`tel`         VARCHAR(200) ,
			`notes`       LONGTEXT ,
			`c_at`        VARCHAR(200) ,
			`u_at`        VARCHAR(200) ,
			st            INT default 1
		) "))
			echo '<div># mic created<br /></div>';
		else echo '<div>(!) mic table error : ' . $db->getError() . ' ;<br /></div>';

		$site_name = "مركز اليابان لتطوير القوي البشرية";
		$description = "مرحباً بكم علي الموقع الرسمي لـ مركز اليابان لتطوير القوي البشرية,أول مركز تدريب عربي في اليابان يقدم الدورات التدريبية وورش العمل والتدريب العملي الفعلي بأحدث وسائل التكنولوجيا اليابانية.
		";

		$mic_args = [
			"name"        => $site_name,
			"description" => $description,
			"keywords"    => $site_name,
			"email"       => "info@" . Config::get("HOST"),
			"tel"         => "",
		];

		/* Insert default Applicaiotn info*/
		$sql = " SELECT * FROM mic WHERE 1 ";

		if (!$db->query($sql)->num_rows) {
			$db->insert($mic_args, "mic", 0);
		}

		#visitors of website
		$audience = $db->query("
			CREATE TABLE  IF NOT EXISTS   `audience` (
			`id`      INT(11)  auto_increment,
			`ip`      VARCHAR(225) ,
			`country` VARCHAR(225) ,
			`r_time`  VARCHAR(100) ,
			`r_date`  VARCHAR(100) ,
			PRIMARY KEY  (`id`)
			)
			");
		if ($audience) echo '<div># audience created<br /></div>';
		else echo '<div>(!) audience table error : ' . $db->getError() . ' ;<br /></div>';


		#Notifications
		$notifications = $db->query("
			CREATE TABLE IF NOT EXISTS  `notifications` (
			`id`            INT  AUTO_INCREMENT PRIMARY KEY ,
			`type`          VARCHAR( 100 )  ,
			`user_id`       VARCHAR(20)  ,
			`notifications` LONGTEXT  ,
			`url`           VARCHAR( 225 )  ,
			`c_at`          VARCHAR( 225 ) ,
			`u_at`          VARCHAR( 225 ) ,
			`st`            INT
			)
			");
		if ($notifications) echo '<div> # notifications  created!</div>';
		else echo "<div> ! notifications table error : " . $db->getError() . "</div>";


		#pages
		if ($db->query("
			CREATE TABLE IF NOT EXISTS `pages` (
			`ID`        INT PRIMARY KEY AUTO_INCREMENT,
			`BETA`      VARCHAR(64),
			`part_id`   VARCHAR (20) default 1,
			`child_id`  VARCHAR (20) ,

			`type`      VARCHAR(100) default 'page',
			`name`      VARCHAR(225) ,
			`slug`      VARCHAR(225) NOT NULL ,
			`content`   LONGTEXT,
			`tags`      MEDIUMTEXT,
			`v`         INT,
			`ava`       VARCHAR(225) ,

			`user_id`   VARCHAR(64),
			`c_at`      VARCHAR(20) ,
			`u_at`      VARCHAR(20) ,
			st INT      default 1
		) "))

			echo '<div># pages created<br /></div>';
		else echo '<div>(!) pages table error : ' . $db->getError() . ' ;<br /></div>';


		#preferences
		if ($db->query("
			CREATE TABLE IF NOT EXISTS `preferences` (
			`ID`    INT  PRIMARY KEY AUTO_INCREMENT ,
			`key`   VARCHAR(200)  ,
			`value` LONGTEXT  ,
			`c_at`  VARCHAR(30)  ,
			`st`    INT  )
			")) {
			echo "<div># preferences table created!</div>";
		} else {
			echo "<div>#preferences table error: " . $db->getError() . "</div>";
		}

		#types
		if ($db->query("
			CREATE TABLE IF NOT EXISTS `types` (
			`ID`       INT  PRIMARY KEY AUTO_INCREMENT ,
			`name`     VARCHAR(200)  ,
			`type`     VARCHAR(200)  ,
			`content`  LONGTEXT  ,
			`content2` LONGTEXT  ,
			`content3` LONGTEXT  ,
			`content4` LONGTEXT  ,
			`content5` LONGTEXT  ,
			`ava`      VARCHAR(200)  ,
			`c_at`     VARCHAR(30)  ,
			`u_at`     VARCHAR(30)  ,
			`st`       INT  )
			")) {
			echo "<div># types table created!</div>";
		} else {
			echo "<div>#types table error: " . $db->getError() . "</div>";
		}


		#Blogs
		if ($db->query("
			CREATE TABLE IF NOT EXISTS  `blogs` (
			`ID`       INT  AUTO_INCREMENT PRIMARY KEY ,
			`BETA`     VARCHAR( 225 )  ,
			`part_id`  VARCHAR(100)  ,
			`child_id` VARCHAR(100)  ,
			`user_id`  VARCHAR( 225 )  ,
			`name`     VARCHAR( 225 )  ,
			`content`  LONGTEXT  ,
			`v`        INT  ,
			`c_at`     VARCHAR( 100 )  ,
			`u_at`     VARCHAR( 100 )  ,
			`e_at`     VARCHAR( 100 )  ,
			`st`       INT ,
			tags       TEXT,
			notes      TEXT
		) ")) {
			echo '<div># blog table created!</div>';
		} else {
			echo '<div> (!) blog table  error :' . $db->getError() . '</div>';
		}


		#Records
		if ($db->query("
			CREATE TABLE IF NOT EXISTS records(
			`ID`       INT AUTO_INCREMENT PRIMARY key,
			`BETA`     VARCHAR(64),
			`c_at`     VARCHAR( 100 ),
			`u_at`     VARCHAR( 100 ),
			`user_id`  VARCHAR( 100 ),
			`st`       INT DEFAULT 1,
			`v`        INT DEFAULT 0,

			`name`     VARCHAR(225),
			`part_id`  INT,
			`type`     VARCHAR(64),
			`audience` LONGTEXT,
			`target`   LONGTEXT,
			`content`  LONGTEXT,
			`ava`      VARCHAR(225),
			`notes`    LONGTEXT,

			`start_at` VARCHAR(225),
			`period`   VARCHAR(225),
			`location` VARCHAR(225) DEFAULT 1,
			`prize`     FLOAT


		)"))

			echo '<div># Records created<br /></div>';
		else echo '<div>(!) Records table error : ' . $db->getError() . ' ;<br /></div>';

		#records_times -> future developing
		if ($db->query("
			CREATE TABLE IF NOT EXISTS records_times(
			`ID`       INT AUTO_INCREMENT PRIMARY key,
			`BETA`     VARCHAR(64),
			`c_at`     VARCHAR( 100 ),
			`u_at`     VARCHAR( 100 ),
			`user_id`  VARCHAR( 100 ),
			`st`       INT DEFAULT 1,

			`c_id`     INT,
			`start_at` VARCHAR(225),
			`period`   VARCHAR(225),
			`location` VARCHAR(225) DEFAULT 1

		)"))

			echo '<div># records_times created<br /></div>';
		else echo '<div>(!) records_times table error : ' . $db->getError() . ' ;<br /></div>';


		/* Default Pages*/
		$pages = ["about", "term-of-use", "help", "libya"];

		foreach ($pages as $key => $p) {
			if (!$db->num_rows("pages", " && slug ='{$p}' ")) {
				$db->insert(["name" => $p, "content" => $p . " content editable from cpanel", "slug" => $p, "st" => 1], "pages", 0);
				pre($p);
			}
		}

		/* Default parts*/
		$parts = [

			" دورات الإدارة",
			" إدارة المكاتب والسكرتارية",
			" الامن والسلامة والصحة والبيئة",
			"التأمين",
			" التربوية والتعليمية والرياضية",
			" الحاسوب وتقنية المعلومات",
			" السياحة والفندقة",
			" الصيانة والإنتاج",
			" العلاقات العامة والمهارات السلوكية",
			"القانون",
			" القطارات والسكك الحديدية",
			" الموارد البشرية والتدريب",
			" الموانئ والنقل والجمارك والمناطق الحرة",
			"النقل البري",
			" غاز وبترول وطاقة",
			" محاسبة – مالية – اقتصاد – استثمار",
			"مشتريات ، مبيعات ، تسويق ، مخازن",
			" هندسة كهرباء الكترونية",
			" هندسة مشاريع وهندسة مدنية",
			" هندسة ميكانيكا",
		];

		if (App::getRouter()->getLanguage() == "en") {
			$parts = [
				"Management",
				"Management and Secretary",
				"Security and Healthy",
				"Insurance",
				"Education ,Teaching ,Sport",
				"Computer &amp; IT &amp; Mobile",
				"Tourism and Hospitality",
				"Protection &amp; Maintenance",
				"Public Relations and skills",
				"Law",
				"Trains and railways",
				"Human Resources &amp; Training",
				"Custom ,Duty Free",
				"Road transport",
				"Gas and Petroleum and Energy",
				"(Accounting – Finance – economy – Investment)",
				"Sales, Marketing and Stores",
				"Electronic Engineering",
				"Civil Engineering",
				"Mechanical Engineering",
			];
		}

		// echo $db->num_rows("tree");

		if ($db->num_rows("tree") < 8) {
			foreach ($parts as $key => $prt) {
				$db->insert(["name" => $prt, "_desc" => $prt, "ava" => LOGO, "st" => 1], "tree", 0);
				pre($prt);
			}
		}

		echo "<hr>";
		echo "<a href = " . url() . " > Home </a> | ";
		echo "<a href = " . url('admin') . " > Admin </a>";
	}
}
