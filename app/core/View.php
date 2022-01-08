<?php

namespace M5\MVC;

class View
{


    public static $_injected;
    public static $renderd;

    function __constrcut($page = '', $data = [], $adminemplate = '')
    {

        $this->page = $page;
        $this->data = $data;
    }

    /**
     * render template
     *
     * @return mixed|null
     */
    public static function render($view, $__data = [], $options = [])
    {
        // ve(func_get_args());
        //parse view path
        $view = parsePagePath($view);

        $page_file = V_PATH . $view . '.php';

        extract($options);

        if (is_readable($page_file) == true) {
            extract($__data);
            $before =  $before ? require_once V_PATH . parsePagePath($before) . ".php" : '';
            require $page_file;
            $jsFile =  $jsFile ? require_once V_PATH . parsePagePath($jsFile) . ".php" : '';
            $after =  $after ? require_once V_PATH . parsePagePath($after) . ".php" : '';
            // ob_end_flush(); // Send the output to the browser
            Self::$renderd = true;
            return ' ';
        } else {
            echo self::notFoundPage($page_file);
            Self::$renderd = true;
        }
    }


    /**
     * That's what does eyes will see
     *
     * @param string $page : page | folder path
     * @param array $data
     * @param String $widgetsTemplate : folder that content header.php footer.php
     * @return Mixed
     */
    public static function _template($page = '', $data = [], $widgetsTemplate = '')
    {
        $page = parsePagePath($page);
        $adminfolder = '';

        // $data[] = self::$_injected ;

        if (Self::$renderd) {
            return false;
        }

        $widgetsTemplate = rtrim($widgetsTemplate, "/");

        $page = strtolower($page) . Config::get('default_view_prefix') . '.php';

        $page = !$adminfolder ?  V_PATH . $page :  V_PATH . 'admin/' . $page;

        $header = !$widgetsTemplate ?  V_PATH . 'widgets/header.php' :  V_PATH . $widgetsTemplate . '/header.php';
        $footer = !$widgetsTemplate ?  V_PATH . 'widgets/footer.php' :  V_PATH . $widgetsTemplate . '/footer.php';

        if (is_readable($page)) {
            // ob_start();
            require $header;
            require $page;
            require $footer;
        } else {
            echo
            $notes = '<span style="color:#F00"> View Error : <u> ' . $page . "</u> [404!] </span>";
        }

        return Self::$renderd = true;
    }

    /**
     * not found page
     * @* @param html $template not found template
     *
     * @return mixed
     */
    static private function notFoundPage($page, $template = '')
    {
        $p404 = '<span style="color:#F00"> View Error : <u> ' . $page . "</u> [404!] </span>";
        return $template ? $template : $p404;
    }

    /**
     * Set somthings
     */
    public function set($key, $value)
    {
        return
            $this->$key = $value;
    }


    /**
     * Get somthings
     */
    public function get($key)
    {
        return
            $this->$key;
    }

    /**
     * inject somthing
     *
     * @return mixed
     */
    public static function inject($values)
    {
        if (!$values) {
            throw new \Exception("params missed!", 1);
        }

        return self::$_injected = $values;
    }
}
