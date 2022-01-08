<?php

namespace M5\Controllers;

use M5\MVC\Controller as BaseController;

class ApiController extends BaseController
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
   function index($args = [])
   {
      return $this->parse($args);
   }

   private function parse($url)
   {
      $data = [
         "status"  => "success",
         "message" => "message",
         "data"    => $url,
      ];

      $controller = strtolower($url[0]) ?? $url;
      $method     = strtolower($url[1]);
      $params     = strtolower($url[2]);

      //string
      if ($controller == 'strings') {
         $data = s('g.' . $url[1]);
         return $this->response($data);
      }

      //getAuth
      if ($controller == strtolower('getAuth')) {
         return $this->response($data);
      }

      $data = [
         "status"  => "error",
         "message" => "404",
         "data"    => $url,
      ];
      return $this->response($data);
   }

   private function response($array)
   {
      echo json_encode($array);
      header('Content-Type : application/json');
   }
}
