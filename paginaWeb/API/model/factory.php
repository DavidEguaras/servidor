<?php


class Factory{

    public static function select($query = "", $params = []){
        $connection = null;
        try{
            
            $dsn = 'mysql:host=' . IP . ';dbname=' . DB_NAME;
            $connection = new PDO($dsn, USER, PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            throw new Exception("Could not connect to database: " . $e->getMessage());
        }
        try {
            $stmt = $connection->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>