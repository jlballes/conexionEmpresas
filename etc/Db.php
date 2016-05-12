<?php

class Db
{
    private $conn = null;
    //format PDO
    private $config = array(
        'username' => 'user',
        'password' => 'pass',
        'hostname' => 'mysql:host=localhost',
        'database' => 'dbname=dokify'
    );

    function __construct() {
        $this->connect();
    }

    function connect() {
        if (is_null($this->conn)) {
            $db = $this->config;
            $this->conn = new PDO($db['hostname'].';'.$db['database'], $db['username'], $db['password']);
            if(!$this->conn) {
                // TODO: lanzar exception
                die("Error");
            }
        }
        return $this->conn;
    }
}

?>