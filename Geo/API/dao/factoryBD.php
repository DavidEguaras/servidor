<?php

require("./config/configBD.php");
class FactoryBD{

    public static function realizaConsulta($sql, $array_parametros)
    {
        try {
            $conn = new PDO('mysql:host=' . IP . ';dbname=' . BD, USER, PASS);
            $stmt = $conn->prepare($sql);
            $stmt->execute($array_parametros);

        } catch (PDOException $e) {
            echo $e->getMessage();
            unset($conn);
        }
        return $stmt;
    }
}

?>