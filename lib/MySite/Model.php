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
use PDO;
use Exception;
use PDOException;

abstract Class Model {
    //rajouter els param pour test
    static protected $_pdo;
    private $_dbname = "my_framework";
    private $_username = "root";
    private $_password = "";
    private $_host = "127.0.0.1";
    private $_unix_socket = "/home/meyerv_p/.mysql/mysql.sock";

    /**
    * getter pdo.
    * @return object pdo object
    */
    public function getPdo(){
        return $this->_pdo;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setPdo($data){
        $this->_pdo=$data;
    }
    /**
    * getter dbname.
    * @return string pdo object
    */
    public function getDbname() {
        return $this->_dbname;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setDbname($data) {
        $this->_dbname = $data;
    }
    /**
    * getter dbname.
    * @return string pdo object
    */
    public function getUsername() {
        return $this->_username;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setUsername($data) {
        $this->_username=$data;
    }
    /**
    * getter dbname.
    * @return string pdo object
    */
    public function getPassword() {
        return $this->_password;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setPassword($data) {
        $this->_password = $data;
    }
    /**
    * getter dbname.
    * @return string pdo object
    */
    public function getHost() {
        return $this->_host;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setHost($data) {
        $this->$_host = $data;
    }
    /**
    * getter dbname.
    * @return string pdo object
    */
    public function getUnix_socket() {
        return $this->_unix_socket;
    }
    /**
    * setter de pdo
    * @param  string $data de donner pour la mise ajour  des donner de connection
    */
    public function setUnix_socket($data) {
        $this->_unix_socket = $data;
    }
    /**
    * CONSTRUCT
    */
    public function __construct(){
        if (!is_object(self::$_pdo)) {
            try
            {
                self::$_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_unix_socket, $this->_username, $this->_password);
            }
            catch (PDOException $e)
            {
                die(print_r($e,true));
            }
        }
    }
    /**
    * Methode de recherche d'annonces
    * @param string $view contien une string de donner pour le where
    * @param array $param contien une array de valeur pour le prepare
    * @return array de donner pour la vue
    */
    public function findOne($condition=null, $value=null) {
        if (is_string($condition) && is_array($value) && !empty($condition) && !empty($value)) {
            if (substr_count($condition, '?') === count($value)) {
                // a voir pour comparer nb_value et nb ? preg_match_all("/?/", $condition);
                $table = preg_replace('/^.+(\\\\(.+))table/', '$2', strtolower(get_class($this)));
                $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition;
                $pdo = self::$_pdo;
                $req = $pdo->prepare($sql);
                $req->execute($value);
                $data = $req->fetch();
                return $data;
            }else {
                throw new Exception("Error not equal key,value for findOne", 1);
            };
        }
    }
}
?>