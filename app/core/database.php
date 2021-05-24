<?php

    class Database 
    {
        public $connection;
        // connectin to the database 
        private function db_connect(){
            try{
                $this->connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $error){
                echo 'No connection '.$error->getMessage();
            }

            return $this->connection;
        }


        public function read($query, $data=[]){
            
            $connection = $this->db_connect();
            $stmt = $connection->prepare($query);

            //  check if data is set 
            if(count($data) < 1){
                $result = $stmt->execute();
            }else{
                $result = $stmt->execute($data);
            }
            
            // fetches data from the database
            if($result){
                return $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }
        public function write($query, $data=[]){
            $connection = $this->db_connect();
            $stmt = $connection->prepare($query);

            //  check if data is set 
            if(!count($data) < 1){
                $result = $stmt->execute($data);
            }else{
                return http_response_code(500);
            }
            
            // fetches data from the database
            if($result){
                return true;
            }
        }
    }