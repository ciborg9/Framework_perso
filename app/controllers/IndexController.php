<?php
/**
 * file description indexcontroller.php content home functionality
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
namespace app\controllers;
use app\models\UserTable;
use MySite\Controller;
/**
 * this class indexcontroller extend Class Controller.
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


class IndexController extends Controller
{

    /**
    * Methode get and display user data "ciborg"
    * de la basse de donner dans une vue
    * @return vue d'affichage
    */
    public function indexAction()
    {
        $model = new UserTable();
        $data = $model->findOne("login = ?", ['ciborg']);
        return $this->render(":ViewFilename", $data);
    }
}
?>