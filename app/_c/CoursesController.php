<?php

namespace M5\Controllers;

use M5\MVC\View;
use M5\Library\DB;
use M5\Models\Times;
use M5\Library\Clean;
use M5\MVC\Controller as BaseController;

class CoursesController extends BaseController
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
   function index($args = null)
   {
      $cond = '';

      $data = [];
      $data['title'] = s('g.courses');

      if ($args) {

         if (!is_array($args)) {
            return $this->details($args);
         }

         //check url contain "part"
         if ($args[0] == 'part') {
            $data['title'] = s('g.courses') . " " . s('g.categories');
            $part_id = abs($args[1]);
            $cond .= " &&(courses.part_id = '$part_id') ";
         }
      }

      //search query
      if ($query = $_GET['q']) {
         $query = Clean::sqlInjection($query);
         $data['title'] = s('g.courses') . " " . s('g.search');
         $cond .= " &&(courses.ttl LIKE '%$query%') ";
      }

      $this_month = date("m");
      $cond .= " &&(MONTH(courses_beta.C_TIME) = '" . $this_month . "') ";

      $courses = Times::_all($cond);

      $data['courses'] = $courses;

      /*SEO */
      $widgets =  [
         'before' => 'layouts.master._header',
         'after'  => 'layouts.master._footer',
         'jsFile' => 'layouts.master._js',
      ];

      return view('courses.courses_view', $data, $widgets);
   }

   /**
    * course details
    *
    * @return object|null
    */
   public function details($id)
   {
      $id = abs($id);

      $page = [];
      $venue = $_GET['venue'] ? $_GET['venue'] : 1;

      $data = [];

      $DB = DB::getInst("courses")->where(" &&(courses.ID = '$id') ");
      $course = $DB::fetchOne();
      $cond = " &&(courses_beta.C_ID = '" . $course->ID . "' && courses_beta.V_ID='" . $venue . "' ) ";

      $times = Times::_all($cond, $page, '', ['printQuery' => false]);
      $course->times = $times;

      // render in view
      $data['title'] = $course->ttl;
      $data['course'] = $course;

      //SEO

      $widgets =  [
         'before' => 'layouts.master._header',
         'after'  => 'layouts.master._footer',
         'jsFile' => 'layouts.master._js',
      ];
      return view('courses.course_details', $data, $widgets);
   }
}
