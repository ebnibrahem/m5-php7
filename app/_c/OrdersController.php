<?php

namespace M5\Controllers;

use M5\Models\Times;
use M5\MVC\Controller as BaseController;

/**
 * Order handler Controller
 *
 */
class OrdersController extends BaseController
{
   public function index()
   {
      $data = [];
      $data['title'] = s('g.courses');

      $time_id = abs($_GET['item_id']);

      if (!$time_id) {
         return null;
      }
      $time = Times::_one($time_id, '', 0);
      // pa($time);
      $data['time'] = $time;
      $data['title'] = $time->ttl;

      $data['action'] = ($_GET['do'] == 'join') ? 'join' : 'enquire';

      $widgets =  [
         'before' => 'layouts.master._header',
         'after'  => 'layouts.master._footer',
         'jsFile' => 'layouts.master._js-index',
      ];

      return view('orders.orders_view', $data, $widgets);
   }
}
