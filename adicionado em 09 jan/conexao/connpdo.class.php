<?php

class ConnPDO {

    private $host = 'localhost';
    private $dbname = 'lab';
    private $user = 'root';
    private $password = '';

    public function getConnection() {
        $db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);

        return $db;
    }
}
