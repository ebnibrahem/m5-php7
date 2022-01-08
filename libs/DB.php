<?php

namespace M5\Library;

use M5\MVC\Config;

/**
 * php class
 *
 */

class DB
{

   protected static $inst;
   protected static $DB;
   protected static $connection_status;
   protected static $sql;
   public static $total = 0;
   public static $offset = 30;
   public static $pages = 0;

   private static $table;
   private static $show_error;
   private static $target;

   public static $cls;

   /**
    * Connect To Database
    *
    */
   private function __construct()
   {
      $_ = Config::get('database');
      // pa($_);

      if (app()->getLanguage() != "ar") {
         $_["database"] = $_["database_en"];
      }

      $connection = new \MySQLi($_["host"], $_["username"], $_["password"], $_["database"]);
      // $connection = new \MySQLi($_["host"], $_["username"], $_["password"], $_["database"], $_["port"]);
      $connection->set_charset("utf8");

      if ($connection->connect_error) {
         Self::$connection_status = 'NOT Established :(';
         /*/ trigger_error(Self::$DB->connect_error,E_USER_ERROR); //set as php runtime error.*/
         die(pre('<h2> :( ' . $connection->connect_error . '</h2>', 'center', '', '#DD3333'));
      } else {
         Self::$connection_status = 'Established Successfully';
         // echo "connections ok!";
      }
      Self::$DB = $connection;
   }

   /**
    * Singleton Approach
    *
    * @return  Object
    */
   public static function getInst($table_name = '', $show_error = false, $target = false)
   {
      Self::$table = $table_name;

      $sql = "SELECT * FROM $table_name WHERE 1 ";
      Self::$sql = $sql;

      if (!isset(Self::$inst)) {
         $class = static::class; /* to multi use of model >> with child class name not (Model)*/
         Self::$cls = $table_name;
         Self::$inst = new $class($show_error);
      }

      Self::$show_error =  $show_error;
      Self::$target     =  $target;

      return Self::$inst;
   }
   /**
    * change table .
    *
    * @param String $table table name
    * @return object|null
    */
   public static function table($table_name)
   {
      Self::getInst($table_name);

      $sql = "SELECT * FROM $table_name WHERE 1 ";
      Self::$sql = $sql;
      return Self::$inst;
   }

   /**
    * @param  string $cond e.g " && 1=1" | " 1=1 " .
    * @return Object
    */
   public function where($cond = ' && 1 ')
   {
      Self::$sql .= " $cond ";

      Self::$sql;
      return Self::$inst;
   }

   /**
    * Geting result's records.
    */
   public static function fetch(array $args = [])
   {
      Self::getInst(Self::$table);
      $sql = Self::$sql . " LIMIT " . Self::$offset;
      $db = Self::$DB;
      $query = $db->query($sql);

      $result = [];

      while ($row = $query->fetch_object()) {
         $result[] = $row;
      }

      return $result;
   }

   /**
    * Fetch One records by passing sql query.
    *
    * @param  String $sql
    * @param  Boolean $printQuery
    * @return mixed
    */
   public static function fetchOne()
   {
      $sql = Self::$sql;
      $db = Self::$DB;
      $query = $db->query($sql);

      return  $query->fetch_object();
   }

   /**
    * get database object
    *@return object|null
    */
   public static function getDB()
   {
      return Self::$DB;
   }

   /**
    * get database sql query
    *
    * @return string
    */
   public static function getSql()
   {
      return Self::$sql;
   }
}
