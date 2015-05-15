<?php
namespace MySite;
use MySite\Exceptions\NotFoundException;
use Exception;

Class Core {

    public static function registerAutoload($class) {
        if (preg_match("/MySite/",$class) && file_exists('../lib/' . $class . '.php')) {
            return require_once '../lib/' . $class . '.php';
        }
        /*var_dump($class);echo "avant if";*/
        if (file_exists('../' . $class . '.php')) {
            /*var_dump($class);echo "var_dump(class)";*/
             return require_once '../' . $class . '.php';
        }
    }

    public static function run() {
        try {
            session_start();
            spl_autoload_register('MySite\Core::registerAutoload');
            /*include('include/log_db.php');*/
            $call = ucfirst(isset($_GET['page']) ? $_GET['page'] : "index");
            $call = explode('/', $call);
            if (file_exists('../app/controllers/'.$call[0].'Controller.php')) // si le controller existe
            {
                $call[1] = isset($call[1]) ? $call[1] : 'index';
                $controller_name = "app\\controllers\\" . $call[0] . 'Controller';
                $action = $call[1]."Action";
                $obj = new $controller_name;
                $obj->$action();
            }
            else // SINON
            {
                throw new NotfoundException();
            }
        } catch(Exception $e) {
            if ($e instanceof NotFoundException) {
                header("HTTP/1.1 404 Not Found");
            } else {
                header("HTTP/1.1 500 Internal Server Error");
            }
        }
    }
}
?>