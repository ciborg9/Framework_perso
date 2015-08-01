<?php
/**
 *file description core controller
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
 *this class is base controller for all child controller
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

abstract Class Controller
{

    /**
    * Methode replace var tag html by content
    * @param string $view  is html code
    * @param array  $param all data content for insert
    * @return void
    */
    public function render($view, $param = array())
    {
        $views = explode(':', $view);
        if (empty($views[0])) {
            $dir = '../app/views/' . $views[1] . '.html';
        } else {
            $dir = '../app/views/' . $views[0] . '/' . $views[1] . '.html';
        }
        if (file_exists($dir)) {
            $file = file_get_contents($dir);
            if (!empty($param)) {
                // process for replace tag html by content
                foreach ($param as $key => $value) {
                    $file = preg_replace('/{{ (' . $key . ') }}/', $value, $file);
                }
            }
            echo $file;
        } else {
            echo "fichier de vue incorrect !!!";
        }
    }
}
?>