<?php namespace M5\Library;

/**
* @ axeing text
* @var string wall : set walls between home rooms
*/
class Axe {
/**
* @param $text
* @param $wordNumber
* @param $sep
* @return mixed
*/
static function word($text, $wordNumber = 10, $sep = '..') {
   $text = strip_tags($text);
   $ex = explode(" ", $text);
   $exCount = count($ex);
   for ($i = 0; $i < $wordNumber; $i++) {
      $showWords .= $ex[$i] . " ";
   }
   if ($exCount > $wordNumber) {
      return $showWords . $sep;
   }

   return $showWords;
}

   /**
   * discover \n and replace with private wall
   *
   */
   static function putLn($text, $wall = "_1987_") {
      $ex = str_replace("\n", $wall, $text);
      return $ex;
   }

   /**
   * @param $text
   * @param $wall
   * @return mixed
   */
   static function optLn($text, $wall = "_1987_") {
      $ex = str_replace($wall, "<br />", $text);
      return $ex;
   }

   /**
   *
   */
   static function knife($text, $boan = "_1987_") {
      $ex = str_replace($boan, "\n", $text);
      return $ex;
   }

   /**
   * Setup link to be accept in url
   *
   * @param $text
   * @param $long
   */
   static function url($text, $long = '70') {
      $ex = str_replace([" ",'\\','/'], "-", $text);
      $ex = mb_substr($ex, 0, $long, "utf8");
      return (preg_match('/localhost/', @$_SERVER['HTTP_HOST'])) ? "-locahost-string" : rawurlencode("-" . $ex);
   }

   /**
   * @param $text
   */
   static function deUrl($text) {
      $ex = str_replace("-", " ", $text);
      return rawurldecode($ex);
   }

   /**
   * @param $text
   * @param $expode
   * @return mixed
   */
   static function first($text, $expode = " ") {
      $e = explode($expode, $text);
      return $e[0];
   }

   /**
   * April 2016
   */
   static function youtube($url) {
      $e = end(explode("watch?v=", $url));
      return $e;
   }

   /**
   * Oct 2019
   */
   static function vimeo($url) {
      $e = explode("/", $url);
      $e = end($e);
      return $e;
   }

 /**
   * prepare link to be accept as url.
   *
   * @param $text
   */
 static function preUrl($text) {
   $ex = trim($text);
   $ex = str_replace(" ", "-", $text);
   return rawurlencode($ex);
}

   /**
   * re-prepare link to be accept as String.
   *
   * @param $text
   */
   static function preUrlGet($text) {
      $ex = trim($text);
      $ex = str_replace("-", " ", $text);
      return rawurldecode($ex);
   }

   /**
   * @param $needle
   * @param $replacement
   * @param $haystack
   */
   static function mb_str_replace($needle, $replacement, $haystack) {
      return implode($replacement, mb_split($needle, $haystack));
   }

   /**
   * tags
   * @param $text
   * @param $sp
   * @return mixed
   */
   static function tags($text, $sp = ',') {
      $ex = trim($text);
      $ex = explode($sp, $text);
      return $ex;
   }

}
