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
        var_dump(basename(__FILE__));
        echo "construct";
        if (empty($this->_pdo)) {
            echo "</br>tentative de co";
            try
            {
                $this->setPdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_unix_socket, 'root', '');
                //$this->_pdo = new PDO('mysql:host=localhost;dbname=common-database;', 'root', '');
                echo "</br>connection";
            }
            catch (Exception $e)
            {
                echo "echec";
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
    public function findOne($condition=null, $value=null) {
        if (is_string($condition) && is_array($value) && !empty($condition) && !empty($value)) {
            // a voir pour comparer nb_value et nb ? preg_match_all("/?/", $condition);
            $table = explode("Table.php", basename(__FILE__));
            $table=$table[0];
            var_dump($table);
            $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition;
            var_dump($sql);
        }
    }
}
?>