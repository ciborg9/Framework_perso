<?php
namespace MySite;
use PDO;

abstract Class Model {
    //rajouter els param pour test
    static protected $_pdo;
    private $_dbname = "my_framework";
    private $_username = "root";
    private $_password = "";
    private $_host = "127.0.0.1";
    private $_unix_socket = "/home/meyerv_p/.mysql/mysql.sock";

    public function getPdo(){
        return $this->_pdo;
    }
    public function setPdo($data){
        $this->_pdo=$data;
    }

    public function getDbname() {
        return $this->_dbname;
    }
    public function setDbname($data) {
        $this->_dbname = $data;
    }

    public function getUsername() {
        return $this->_username;
    }
    public function setUsername($data) {
        $this->_username=$data;
    }

    public function getPassword() {
        return $this->_password;
    }
    public function setPassword($data) {
        $this->_password = $data;
    }

    public function getHost() {
        return $this->_host;
    }
    public function setHost($data) {
        $this->$_host = $data;
    }

    public function getUnix_socket() {
        return $this->_unix_socket;
    }
    public function setUnix_socket($data) {
        $this->_unix_socket = $data;
    }

    public function __construct(){
        var_dump(basename(__CLASS__)."ee");echo "test";
        echo "construct";
        if (empty($this->_pdo)) {
            echo "</br>tentative de co";
            try
            {
                self::$_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_unix_socket, $this->_username, $this->_password);
                //$this->_pdo = new PDO('mysql:host=localhost;dbname=common-database;', 'root', '');
                echo "</br>connection";
            }
            catch (PDOException $e)
            {
                die(print_r($e,true));
            }
        }
    }
    public function findOne($condition=null, $value=null) {
        if (is_string($condition) && is_array($value) && !empty($condition) && !empty($value)) {
            if (substr_count($condition, '?') === count($value)) {
                // a voir pour comparer nb_value et nb ? preg_match_all("/?/", $condition);
                $table = preg_replace('/^.+(\\\\(.+))table/', '$2', strtolower(get_class($this)));
                $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition;
                $pdo = self::$_pdo;
                $req = $pdo->prepare($sql);
                $req->execute($value);
                $data = $req->fetchAll();
                var_dump($data);
                return $data;
            };
        }
    }
}
?>