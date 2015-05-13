<?php
namespace MySite;
use PDO;

abstract Class Model {
    //rajouter els param pour test
    protected static $_pdo;
    private static $_dbname;
    private $_username;
    private $_password;
    private $_host;
    private $_unix_socket;

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
        if (empty($this->_pdo)) {
            try
            {
                $this->_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_unix_socket, 'root', '');
                //$this->_pdo = new PDO('mysql:host=localhost;dbname=common-database;', 'root', '');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
}
?>