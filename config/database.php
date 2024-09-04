<?php

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = getenv('APP_HOST') ?: 'localhost';
        $this->db_name = getenv('APP_DATABASE_NAME') ?: 'crud_db';
        $this->username = getenv('APP_DATABASE_USER_NAME') ?: 'root';
        $this->password = getenv('APP_DATABASE_PASSWORD') ?: 'root_password';
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

