<?php


class Factory{
    protected $connection = null;

    public function __construct(){
        try{
            $dsn = 'mysql:host=' . IP . ';dbname=' . DB_NAME;
            $this->connection = new PDO($dsn, USER, PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            throw new Exception("Could not connect to database: " . $e->getMessage());
        }
    }


    public function select($query = "", $params = []){
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}



?>