<?php

    class Database {
        //DB Params
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $port;
        private $conn;

        public function __construct(){
            
            $this->host = getenv('HOST');
            $this->port= getenv('PORT');
            $this->db_name = getenv('DBNAME');
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');

        }

        //DB Connect
        public function connect() {
            if($this->conn = null) {
                return $this->conn;
            } else {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

                try{
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            }   catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        
        return $this->conn;
        }
    }
}


    
