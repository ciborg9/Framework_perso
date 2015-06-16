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

abstract Class Controller
{

    /**
    * Methode de recherche d'annonces
    * @param string $view  contien une string de donner pour le where
    * @param array  $param contien une array de valeur pour le prepare
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
        //var_dump($views);
        if (file_exists($dir)) {
            $file = file_get_contents($dir);
            if (!empty($param)) {
                // traitement de remplacement des clé
                // par les valeur avec preg_replace
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