<?php
    class MySQL
    {
        private $host = "mysql:host=localhost;dbname=task-web";
        private $user = "root";
        private $pass = "";
        private $conn;

        public function __construct()
        {
            $this->conn = new PDO($this->host, $this->user, $this->pass);
        }
 
        public function getConnection()
        {
            return $this->conn;
        }
    }
