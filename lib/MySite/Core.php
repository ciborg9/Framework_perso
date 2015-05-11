<?php
namespace MySite;

Class Core {

    public static function registerAutoload($class) {
        /*$class = explode('\\', $class);*/
        if (file_exists('../' . $class . '.php')) {
            require '../' . $class . '.php';
        }
    }

    public static function run() {
        session_start();
        spl_autoload_register('MySite\Core::registerAutoload');

        /*include('include/log_db.php');*/
        $call = ucfirst(isset($_GET['page']) ? $_GET['page'] : "");
        $call = explode('/', $call);
        var_dump($call);
        if (file_exists('../app/controllers/'.$call[0].'Controller.php')) // si le controller existe
        {
            if (!isset($call[1]) || $call[1] === '') {
                $call[1] = 'index';
            }
            //include "../app/controllers/".$call[0]."Controller.php";
            $controller_name = "app\\controllers\\" . $call[0] . 'Controller';
            $action = $call[1]."Action";
            $obj = new $controller_name;
            $obj->$action();
            //call_user_func($call[0] . 'Controller' . '::' . $call[1] . 'Action');
        }
        else // SINON
        {
           include "../app/controllers/HomeController.php";
        }
    }
}
?>