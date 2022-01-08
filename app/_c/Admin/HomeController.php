<?php

namespace M5\Controllers\Admin;

use M5\MVC\Controller as BaseController;

class HomeController extends BaseController
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

      $widgets =  [
         'jsFile' => 'layouts.master._js',
      ];

      return view(ADMIN_PREFIX . '.home-page', $data, $widgets);
   }
}
