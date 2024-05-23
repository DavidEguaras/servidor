<?php
class Factory
{
    protected static function connect()
    {
        $dsn = 'mysql:host=' . IP . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            $pdo = new PDO($dsn, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    protected static function select($query, $params = [])
    {
        try {
            $stmt = self::connect()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Select query failed: ' . $e->getMessage());
        }
    }

    protected static function insert($query, $params = [])
    {
        try {
            $stmt = self::connect()->prepare($query);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Insert query failed: ' . $e->getMessage());
        }
    }
}
?>
