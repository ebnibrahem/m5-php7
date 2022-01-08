<?php

namespace M5\Library;

use M5\MVC\Config;

class MySqlClass
{

   public static function db()
   {
      $_ = Config::get('database');
      // pa($_);

      /*change database depending on language */
      if (app()->getLanguage() != "ar") {
         $_["database"] = $_["database_en"];
      }

      try {
         $connection = new \MySQLi($_["host"], $_["username"], $_["password"], $_["database"]);
         $connection->set_charset("utf8");

         if ($connection->connect_error) {
            die(pre('<h2> :( ' . $connection->connect_error . '</h2>', 'center', '', '#DD3333'));
         }
      } catch (\mysqli_sql_exception $e) {
         echo $e->__toString();
         return null;
      }
      // pa($connection);

      return $connection;
   }


   /**
    * Execute Query against database.
    *
    * @param String $sql
    * @return object
    */
   public static function query($sql)
   {
      $dirver = new MySqlClass();
      $db = $dirver->db();
      return  $db->query($sql);
   }

   /**
    * get result from Mysql Object
    *
    * @param object $query
    * @return object|null
    */
   public static function fetch(Object $query)
   {
      $result = [];
      if ($query) {
         while ($row = $query->fetch_object()) {
            $result[] = $row;
         }

         return $result;
      }
   }

   /**
    * get mysql rows from Mysql sql query
    *
    * @param object $query
    * @return object|null
    */
   public static function select($sql)
   {
      $result = [];
      $query = Self::query($sql);
      if ($query) {
         while ($row = $query->fetch_object()) {
            $result[] = $row;
         }
      }

      return $result;
   }
}
