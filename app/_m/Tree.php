<?php

namespace M5\Models;

use M5\MVC\Model;
use M5\Library\MySqlClass;

class Tree extends Model
{

   protected $table = 'parts';
   protected $model;

   /**
    * get all categories.
    *
    * @return Object|null
    */
   public static function getLevel()
   {
      $dirver = new MySqlClass();
      $result = $dirver->select("SELECT * FROM parts");
      return $result;
   }
}
