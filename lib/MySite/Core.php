<?php
/**
 *Description du fichier modeles Annoncescontroller.php
 *fichier contenant la Class Annonces()
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
/**
 *Description du fichier controleurs/User.php
 *Class User heritant de Table Model
 *gestionnaire des users
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
use MySite\exceptions\NotFoundException;
use Exception;

Class Core {
    /**
    * Methode de recherche d'annonces
    * @param string $class contien une string namespace de la class a charger
    * @return string retourne l'include d'une class
    */
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
    /**
    * Methode d"execution du framework
    */
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