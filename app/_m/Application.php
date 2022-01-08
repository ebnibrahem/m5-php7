<?php

namespace M5\Models;

use M5\MVC\Model;
use M5\Library\MySqlClass;

class Application extends Model
{

   protected static $table = 'mic';
   protected $model;

   /**
    * get application.
    *
    * @return Object|null
    */
   public static function getApp()
   {
      $dirver = new MySqlClass();
      $result = $dirver->select("SELECT * FROM " . Self::$table . " WHERE 1 LIMIT 1");
      return $result ? $result[0] : [];
   }

   /**
    * get application social media.
    *
    * @return Object|null
    */
   public static function getSn()
   {
      $dirver = new MySqlClass();
      $result = $dirver->select("SELECT * FROM `setting` WHERE 1 LIMIT 1");
      return $result ? $result[0] : [];
   }
}
