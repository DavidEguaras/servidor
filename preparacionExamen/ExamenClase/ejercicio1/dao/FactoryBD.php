<?

class FactoryBD{
    public static function realizaConsulta($sql,$array_parametros){
        try{
            $conn = new PDO('mysql:host='.IP.';dbname='.BBDD,USER,PASS);
            $stmt = $conn->prepare($sql);
            $stmt->execute($array_parametros);
        } catch(PDOException $e) {
            $stmt = null;
            //echo $e->getMessage();
            unset($conn);
        }
        return $stmt;
    }
}