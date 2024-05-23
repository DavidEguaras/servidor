<?php

class Factory
{
    private static $connection;

    private static function connect()
    {
        if (!self::$connection) {
            try {
                self::$connection = new PDO("mysql:host=" . IP . ";dbname=" . DB_NAME, USER, PASS);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Connection error: " . $e->getMessage());
            }
        }
    }

    protected static function select($query, $params = array())
    {
        self::connect();
        try {
            $stmt = self::$connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query error: " . $e->getMessage());
        }
    }


    protected static function execute($query, $params = array())
    {
        self::connect();
        try {
            $stmt = self::$connection->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("Query error: " . $e->getMessage());
        }
    }
}

?>
