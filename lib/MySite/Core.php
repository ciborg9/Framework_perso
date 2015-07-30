<?php
/**
 *file description this Core Framework
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category Modeles
 * @package  None
 * @author   Original Author <meyerv_p@epitech.eu>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     null
*/
namespace MySite;
use MySite\exceptions\NotFoundException;
use Exception;
/**
 *Core Class is base framework
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Class
 * @package   None
 * @author    Original Author <meyerv_p@epitech.eu>
 * @copyright 1997-2005 The PHP Group
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 * @link      null
*/

Class Core
{
    /**
    * Methode autoloading by namespacec
    * @param string $class namespace class to load
    * @return string return inclusion of class
    */
    public static function registerAutoload($class)
    {
        if (preg_match("/MySite/", $class) && file_exists('../lib/'.$class.'.php')) {
            return include_once '../lib/' . $class . '.php';
        }
        if (file_exists('../' . $class . '.php')) {
            return include_once '../' . $class . '.php';
        }
    }
    /**
    * Methode run framework
    * @return void
    */
    public static function run()
    {
        try {
            session_start();
            spl_autoload_register('MySite\Core::registerAutoload');
            /*include('include/log_db.php');*/
            $call = ucfirst(isset($_GET['page']) ? $_GET['page'] : "index");
            $call = explode('/', $call);
            if (file_exists('../app/controllers/'.$call[0].'Controller.php')) {
                /* if controller set*/
                $call[1] = isset($call[1]) ? $call[1] : 'index';
                $controller_name = "app\\controllers\\" . $call[0] . 'Controller';
                $action = $call[1]."Action";
                $obj = new $controller_name;
                if (method_exists($obj, $action)) {
                    $obj->$action();
                } else {
                    throw new NotFoundException("methode not found", 666);
                }
            } else {
                throw new NotfoundException();
            }
        } catch(Exception $e) {
            if ($e instanceof NotFoundException) {
                if ($e->getCode() === 666) {
                    echo $e->getMessage();
                }
                header("HTTP/1.1 404 Not Found");
            } else {
                header("HTTP/1.1 500 Internal Server Error");
            }
        }
    }
}
?>