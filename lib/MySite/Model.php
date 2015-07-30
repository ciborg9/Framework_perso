<?php
/**
 *file description model base for all other model extend
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
use PDO;
use Exception;
use PDOException;
/**
 * Class model base acces to bdd and project model
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

abstract Class Model
{
    //add file for auto conf
    static protected $pdo;
    private $_dbname = "my_framework";
    private $_username = "root";
    private $_password = "";
    private $_host = "127.0.0.1";
    private $_unix_socket = "/home/meyerv_p/.mysql/mysql.sock";

    /**
    * Getter pdo.
    * @return object pdo object
    */
    public function getPdo()
    {
        return $this->pdo;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setPdo($data)
    {
        $this->pdo=$data;
    }
    /**
    * Getter dbname.
    * @return string pdo object
    */
    public function getDbname()
    {
        return $this->_dbname;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setDbname($data)
    {
        $this->_dbname = $data;
    }
    /**
    * Getter dbname.
    * @return string pdo object
    */
    public function getUsername()
    {
        return $this->_username;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setUsername($data)
    {
        $this->_username=$data;
    }
    /**
    * Getter dbname.
    * @return string pdo object
    */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setPassword($data)
    {
        $this->_password = $data;
    }
    /**
    * Getter dbname.
    * @return string pdo object
    */
    public function getHost()
    {
        return $this->_host;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setHost($data)
    {
        $this->$_host = $data;
    }
    /**
    * Getter dbname.
    * @return string pdo object
    */
    public function getUnixSocket()
    {
        return $this->_unix_socket;
    }
    /**
    * Setter de pdo
     *
    * @param string $data
    *
    * @return void
    */
    public function setUnixSocket($data)
    {
        $this->_unix_socket = $data;
    }
    /**
    * CONSTRUCT
    *
    * @return void
    */
    public function __construct()
    {
        if (!is_object(self::$pdo)) {
            try
            {
                self::$pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_unix_socket, $this->_username, $this->_password);
            }
            catch (PDOException $e)
            {
                die(print_r($e, true));
            }
        }
    }
    /**
    * Methode search one resulte on database
    * @param string $condition contien une string de donner pour le where
    * @param array  $value     contien une array de valeur pour le prepare
    * @return array de donner pour la vue
    */
    public function findOne($condition=null, $value=null)
    {
        if (is_string($condition) && is_array($value) && !empty($condition) && !empty($value)) {
            if (substr_count($condition, '?') === count($value)) {
                // four back slash for windows ?
                $table = preg_replace('/^.+(\\\\(.+))table/', '$2', strtolower(get_class($this)));
                $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition;
                $pdo = self::$pdo;
                $req = $pdo->prepare($sql);
                $req->execute($value);
                $data = $req->fetch();
                return $data;
            } else {
                throw new Exception("Error not equal key,value for findOne", 1);
            };
        }
    }
}
?>