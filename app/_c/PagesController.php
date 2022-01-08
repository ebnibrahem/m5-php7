<?php

namespace M5\Controllers;

use M5\MVC\View;
use M5\MVC\Controller as BaseController;

class PagesController extends BaseController
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
      $data['title'] = s('g.pages');

      $widgets =  [
         'before' => 'layouts.master._header',
         'after'  => 'layouts.master._footer',
         'jsFile' => 'layouts.master._js-index',
      ];
      return view('pages.page_view', $data, $widgets);
   }
}
